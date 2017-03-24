<?php
namespace App\Http\Controllers;
use App\User;
use App\Profile;
use App\Requestvideo;
use App\RequestedVideo;
use App\Video;
use App\OriginalVideo;
use App\Slider;
use App\Notification;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;
use App\Http\Requests;
use Hash;
use Validator;
use Mail;
use Auth;
use Carbon\Carbon;
use FFMpeg;
use Session;
use Snipe\BanBuilder\CensorWords;
use App\Testimonial;
class LoginController extends Controller{
	
	
	public function __construct()
	{

		$this->middleware('user_active');
		$this->middleware('revalidate');
	}
	public function user_change_password(){
		if(Auth::check()){
			if(Auth::user()->type=="Admin"){
				return redirect('admin_dashboard');
			}elseif (Auth::user()->type=="User") {
				
				return view('frontend.change_user_password');
				//return redirect('/');
			}else{
				return redirect('/');
			}
		}else{
			return redirect('/login');
			// return view('frontend.login');
		}	
	}
	public function post_user_change_password(Request $request){
		if(Auth::check()){
			$data = $request->all();
			$messages = [

			'new_pass.regex' => ' Use at least one letter, one numeral & one special character',
			// 'old_pass.regex' => ' Use at least one letter, one numeral & one special character',
			'new_pass.min' => ' New password should be at least 8 characters ',
			'old_pass.min' => ' Old password should be at least 8 characters',
			'conf_pass.min' => ' Confirm password should be at least 8 characters',
			];
			$validator = Validator::make($data,
				array(
					'old_pass' =>'required',
					'new_pass' =>'required|min:8|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$/',
					'conf_pass' =>'required|min:8|same:new_pass',
					)
				);
			if($validator->fails()){
				return \Redirect::back()
				->withErrors($validator)
				->withInput();

			}else{
				$user = User::find(Auth::user()->user_id);
				$old_password=$request->old_pass;
				$new_password=$request->new_pass;
				if(Hash::check($old_password, $user->getAuthPassword())){
					$user->password = Hash::make($new_password);
					if($user->save()){
						Session::put('password',$new_password);
						// return redirect('/user_change_password')->with('error',"Password Changed Successfully");
						return \Redirect::back()->with('pass_success',"Password Changed Successfully");

					}
				}
				else{
					return \Redirect::back()->with('error',"Invalid Old password");
				}
			}
		}else{
			return \Redirect::back();
		}
	}
	public function webcame($id){
		if(Auth::check()){
			if(Auth::user()->type=="Admin"){
				return redirect('admin_dashboard');
			}
			elseif (Auth::user()->type=="User") {
				return redirect('/');
			}
			else{
				$requested_video=Requestvideo::find($id);

				$requested_user = DB::table('requestvideos')
				->join('profiles', 'requestvideos.requestByProfileId', '=', 'profiles.ProfileId')
				->select('*')
				->get();
				if($requested_video == null){
					return redirect (url()->previous());
				}else if($requested_user == null){
					return redirect('/video_requests')->with('success','user not exist!');
				}
				else{
					$user_id=$requested_video->requestByProfileId;
					//$profileData =  Profile::where('EmailId',Auth::user()->email)->first();
					$user=Profile::find($user_id);
					$artist =  Profile::where('EmailId',Auth::user()->email)->first();
					$artist_data['artist'] = $artist;
					$artist_data['user'] = $user;
					$artist_data['requested_video'] = $requested_video;
					return view('frontend.artistDashboard.webcame',$artist_data);
				}
			}
		}else{
			return redirect('/login');
			// return view('frontend.login');
		}	
	}
	public function logins() {
		return view('frontend.login');
	}
	public function registers() {
		return view('frontend.register');
	}

	public function error_handling(){
		//echo "test";
		return view('frontend.error');
	}
	public function edit_sample_video($id){
		if(Auth::check()){
			if(Auth::user()->type=="Admin"){
				return redirect('admin_dashboard');
			}
			elseif (Auth::user()->type=="User") {
				return redirect('/');
			}
			else{
				$artist =  Profile::where('EmailId',Auth::user()->email)->first();
				$artist_data['artist'] = $artist;
				$video_data=DB::table('video')->where('VideoId',$id)->first();
				//dd($video_data);
				$artist_data['video_data'] = $video_data;
				return view('frontend.artistDashboard.edit_sample_video',$artist_data);
			}
		}else{
			return redirect('/login');
		}	
	}
	public function post_edit_sample_video(Request $request){
		$validator = Validator::make(
			array(
				'video_title' =>$request->video_title,
				'video_description' => $request->video_description,
				'video' =>$request->file('video'),
				),
			array(
				'video_title' =>'required',
				'video_description' =>'required|min:80',
				'video' => 'mimes:mp4,mpeg',
				)
			);
		if($validator->fails())
		{
			return redirect('edit_sample_video/'.$request->video_id)
			->withErrors($validator)
			->withInput();
		}
		else
		{
			//dd($request->all());
			$video =  Video::find($request->video_id);
			$file = $request->file('video');
			if($file != ''){
				$extension = $file->getClientOriginalExtension();
				$filename = str_replace(' ', '', $file->getClientOriginalName());
				$filename = str_replace('-', '', $filename);
				$VideoURL = "http://videorequestlive.com/video/".date('U') .$filename ;
				$video->VideoFormat = $file->getClientOriginalExtension();
				$video->VideoSize = ($file->getSize()/1024) . "mb";
			}
			
			$video->Description = $request->video_description;
			$video->Title = $request->video_title;
			$video->VideoUploadDate = Carbon::now()->format('m-d-Y');
			if($video->save()){
				return redirect('edit_sample_video/'.$request->video_id)->with('success','Video updated Successfully');

			}

		}
	}
	public function edit_socialLink($id){
		if(Auth::check()){
			if(Auth::user()->type=="Admin"){
				return redirect('admin_dashboard');
			}
			elseif (Auth::user()->type=="User") {
				return redirect('/');
			}
			else{
				//echo "hello";
				$artist =  Profile::where('EmailId',Auth::user()->email)->first();
				$artist_data['artist'] = $artist;
				$social_data=DB::table('social media')->where('id',$id)->first();
				$artist_data['social_data'] = $social_data;
				return view('frontend.artistDashboard.edit_socialLink',$artist_data);
			}
		}else{
			return redirect('/login');
		}

	}
	public function post_enable_socialLink($id){
		if( DB::table('social media')
			->where('id',$id)
			->update(array('is_active' => 'Enable' ))){
			return redirect('/get_social_link')->with('success',"Enable Successfully");
	}else{
		return redirect('/get_social_link')->with('success',"Update Not Successfully");
	}

}
public function post_disable_socialLink($id){

	if( DB::table('social media')
		->where('id',$id)
		->update(array('is_active' => 'Disable' ))){
		return redirect('/get_social_link')->with('success',"Disable Successfully");
}else{
	return redirect('/get_social_link')->with('success',"Update Not Successfully");
}
}


public function post_edit_socialLink(Request $request){
	if(Auth::check()){
		$data = $request->all();
		$validator = Validator::make($data,
			array(
				'name' =>'required',
				'social_img' =>'required||mimes:jpeg,png',
				'social_url' =>'required',
				)
			);
		if($validator->fails()){
			return redirect( url()->previous())
			->withErrors($validator)
			->withInput();
		}else{
			if($request->social_img ==""){
				$profile_path=$request->image_path;
			}
			else{
				if($request->file('social_img') != ""){
					$file = $_FILES["social_img"]['tmp_name'];
					list($width, $height) = getimagesize($file);
					if($width > 80 || $height >80) {
						return redirect('/edit_social_link/'.$request->SocialId)->with('success','image size must be 80 x 80 pixels.');
					}else{
						$file = $request->file('social_img');
						$filename = $file->getClientOriginalName();
						$extension = $file->getClientOriginalExtension();
						$profile_path = "socialLink/".date('U').'.jpg';
						$destinationPath = base_path() . '/public/socialLink/';
						$request->file('social_img')->move($destinationPath, $profile_path);
					}
				}	
			}


			if(DB::table('social media')->where('id','=',$request->SocialId)->update(
				array('social_name' => $request->name, 'social_img' => $profile_path,'social_url' =>$request->social_url))){
				return redirect('/edit_social_link/'.$request->SocialId)->with('success',"Successfully Updated ");	
		}else{
			return redirect('/edit_social_link/'.$request->SocialId)->with('error',"Not Successfully Updated ");
		}


	}
}else{
	return redirect('/login');
}
}
public function delete_sample_video($id){
	if(Auth::check()){
		if(Auth::user()->type=="Admin"){
			return redirect('admin_dashboard');
		}
		elseif (Auth::user()->type=="User") {
			return redirect('/');
		}
		else{
			//echo $id;
			if(DB::table('video')->where('VideoId',$id)->delete()){
				return redirect('/artist_video')->with('success',"Delete Successfully");
			}else{
				return redirect('/artist_video')->with('error',"Deletion Not Successfully ");
			}
		}
	}else{
		return redirect('/login');
		// return view('frontend.login');
	}

}

public function delete_socialLink($id){
	if(Auth::check()){
		if(Auth::user()->type=="Admin"){
			return redirect('admin_dashboard');
		}
		elseif (Auth::user()->type=="User") {
			return redirect('/');
		}
		else{
			if(DB::table('social media')->where('id',$id)->delete()){
				return redirect('/get_social_link')->with('success',"Delete Successfully");
			}else{
				return redirect('/get_social_link')->with('error',"Deletion Not Successfully ");
			}
		}
	}else{
		return redirect('/login');
			// return view('frontend.login');
	}

}
public function add_more_social_link(){
	if(Auth::check()){
		if(Auth::user()->type=="Admin"){
			return redirect('admin_dashboard');
		}
		elseif (Auth::user()->type=="Artist") {
			$artist =  Profile::where('EmailId',Auth::user()->email)->first();
			$artist_data['artist'] = $artist;
				//dd($artist);
			return view('frontend.artistDashboard.addMore_socialLink',$artist_data);
		}
		else{
			return redirect('/');
		}
	}else{
		return redirect('/login');
	}

}
public function post_add_more_social_link(Request $request){
		//dd($request->all());
	if(Auth::check()){
		$data = $request->all();
			//dd($data);
		$validator = Validator::make($data,
			array(
				'name' =>'required',
				'social_img' =>'required||mimes:jpeg,png',
				'social_url' =>'required',
				)
			);
		if($validator->fails()){
			return redirect( url()->previous())
			->withErrors($validator)
			->withInput();
		}else{
				 //dd($request->all());
			if($request->social_img ==""){
				$profile_path="images/Artist/default-artist.png";
			}
			else{
				if($request->file('social_img') != ""){
					$file = $_FILES["social_img"]['tmp_name'];
					list($width, $height) = getimagesize($file);
					if($width > 1250 || $height >1250) {
						return redirect('/addMore_social_link')->with('success','image size must be 1250 x 1250 pixels.');
					}else{
						$file = $request->file('social_img');
						$filename = $file->getClientOriginalName();
						$extension = $file->getClientOriginalExtension();
						$profile_path = "socialLink/".date('U').'.jpg';

						$destinationPath = base_path() . '/public/socialLink/';
						$request->file('social_img')->move($destinationPath, $profile_path);
					}
				}	

			}


			if(DB::table('social media')->insert(
				array('social_name' => $request->name, 'social_img' => $profile_path,'social_url' =>$request->social_url,'addBy_profileId' =>$request->ProfileId,'is_active'=>'Enable'))){
				return redirect('/get_social_link')->with('success',"Successfully Added ");	
		}else{
			return redirect('/get_social_link')->with('error',"Not Successfully Added ");
		}


	}
}else{
	return redirect('/login');
}
}
/*--------------------------------User Change Email--------------------*/
public function user_change_email(){
	if(Auth::check()){
		if(Auth::user()->type=="Admin"){
			return redirect('admin_dashboard');
		}
		elseif (Auth::user()->type=="Artist") {
			return redirect('/');
		}
		else{
			$id = Auth::user()->profile_id;
			$name= Auth::user()->user_name;
			$profile_id= Auth::user()->profile_id;
			$user = Profile::find(Auth::user()->profile_id);
			$artist = Profile::where('type','Artist')->get();
			$pageData['user'] = $user;
			$pageData['artist'] = $artist;
			return view('frontend.UserChangeEmail',$pageData);
		}
	}
	else
	{
		return redirect('/login');
	}
}

/*---------------------------user dashaboard---------------------------*/
public function post_user_dashboard(){
	if(Auth::check()){
		if(Auth::user()->type=="Admin"){
			return redirect('admin_dashboard');
		}
		elseif (Auth::user()->type=="Artist") {
			return redirect('/');
		}
		else{
			$id = Auth::user()->profile_id;
			$name= Auth::user()->user_name;
			$profile_id= Auth::user()->profile_id;
			$user = Profile::find(Auth::user()->profile_id);
			$my_videos = DB::table('requested_videos')->where('requestBy',$profile_id)
			->where('is_active','<>','1')->orderBy('id','desc')
			->get();

			$artist = Profile::where('type','Artist')->get();

			$request_details = DB::table('requestvideos')
			->join('profiles','profiles.ProfileId','=','requestvideos.requestToProfileId')
			->where('requestvideos.requestByProfileId',$profile_id)
			->where('requestvideos.is_delete','=','')->orderBy('VideoReqId','desc')
			->get();
			$pageData['user'] = $user;

			$pageData['my_videos'] = $my_videos;
			$pageData['artist'] = $artist;
			$pageData['request_details'] = $request_details;
			$pageData['baseurl'] = "http://videorequestlive.com/";
				//dd($pageData);
			return view('frontend.UserDashboard',$pageData);
		}
	}
	else
	{
		return redirect('/login');
			// return view('frontend.login');
	}
}
/*-------------------------------Price calculation--------------------*/
public function price_cal(){
	echo "test";
}
/*---------------------- User video show -----------------------------*/
public function post_user_video(){
	if(Auth::check()){
		if(Auth::user()->type=="Admin"){
			return redirect('admin_dashboard');
		}
		elseif (Auth::user()->type=="Artist") {
			return redirect('/');
		}
		else{
			$profile_id= Auth::user()->profile_id;
			$user_email= Auth::user()->email;
			$my_videos = DB::table('requested_videos')->where('requestBy',$profile_id)
			->where('is_active','=','1')->where('remain_storage_duration','!=','disable')->orderBy('id','desc')
			->get();
			$purge_data = DB::table('setting')->select('status')->where('name','=',"purge")->first();
			//dd($purge_data->status);
			if(!is_null($my_videos)){
				foreach ($my_videos as $my_video) {
					$now = new \DateTime();
					$date1=date_create($my_video->purchase_date);
					$diff=date_diff($date1,$now);
					$diff_date=$diff->format("%a");
					if($my_video->url!='removed'){
						//if($purge_data!=null){
						if($my_video->remain_storage_duration-$diff_date == 0){
							$source = "requested_video/";
							$destination = "requested_video/backup_video/";
							DB::table('requested_videos')->where('id',$my_video->id)->update(array('desti_url' => $my_video->url,'url'=>'removed','remain_storage_duration'=>0 ));
							$st=substr($my_video->url,44);
							$file=$st;
							if (copy($source.$file, $destination.$file)) {
								$delete[] = $source.$file;
							}
							foreach ($delete as $file) {
								unlink($file);
							}
						}

						/*}else{
							if($diff_date>=$my_video->remain_storage_duration){
								$source = "requested_video/";
								$destination = "requested_video/backup_video/";
								DB::table('requested_videos')->where('id',$my_video->id)->update(array('desti_url' => $my_video->url,'url'=>'removed','remain_storage_duration'=>0 ));
								$st=substr($my_video->url,44);
								$file=$st;
								if (copy($source.$file, $destination.$file)) {
									$delete[] = $source.$file;
								}
								foreach ($delete as $file) {
									unlink($file);
								}
							}

						}*/
						
					}
				}
			}
			
			$pageData['my_videos'] = $my_videos;
			$pageData['purge_data'] = $purge_data;
			$pageData['user_email'] = $user_email;

			return view('frontend.UserVideo',$pageData);

		}
	}
	else{
		return redirect('/login');
	}
}
/*----------------------Artist testimonial view-------------------*/
public function view_testimonial(){
	if(Auth::check()){
		if(Auth::user()->type=="Admin"){
			return redirect('admin_dashboard');
		}
		elseif (Auth::user()->type=="User") {
			return redirect('profile');
		}
		else{
			$artist =  Profile::where('EmailId',Auth::user()->email)->first();
			$artist_data['artist'] = $artist;
			$testi_data =  Testimonial::where('to_profile_id',Auth::user()->profile_id)->orderBy('id','desc')->get();
			$artist_data['testi_data'] = $testi_data;
			return view('frontend.artistDashboard.view_testimonial',$artist_data);
		}
	}
	else{
		return redirect('/login');
	}
}
/*----------------------Artist testimonial add-------------------*/
public function add_testimonial(){
	if(Auth::check()){
		if(Auth::user()->type=="Admin"){
			return redirect('admin_dashboard');
		}
		elseif (Auth::user()->type=="User") {
			return redirect('profile');
		}
		elseif (Auth::user()->type=="Artist"){
			$artist =  Profile::where('EmailId',Auth::user()->email)->first();
			$artist_data['artist'] = $artist;

			return view('frontend.artistDashboard.add_testimonial',$artist_data);
		}
		else{

		}
	}
	else{
		return redirect('/login');
	}
}
public function post_add_testimonial(Request $request){
	if(Auth::check()){
		$data = $request->all();
			//dd($data);
		$validator = Validator::make($data,
			array(
				'message' =>'required'
				)
			);
		if($validator->fails()){
			return redirect( url()->previous())
			->withErrors($validator)
			->withInput();
		}else{
			$artist_id =  User::where('profile_id',Auth::user()->profile_id)->first();
			if($artist_id->is_account_active==1)
			{
				$user = Auth::user();
				$testimonial =   new Testimonial();
				$testimonial->by_profile_id = $user->profile_id;
				$testimonial->to_profile_id = $user->profile_id;
					//$testimonial->video_id = $request->video_id;
				$testimonial->AdminApproval = 0;
				$testimonial->testi_date = date('d-m-Y');
				$censor = new CensorWords;
				$string = $censor->censorString($request->message);
				$testimonial->message = $string['clean'];
				if($testimonial->save()){
					return redirect( url()->previous())->with('success','Your Comment is Under review');
				}
			}else{
				return redirect( url()->previous())->with('error','You can not sent any request to Artist because Artist is Deactivated');
			}
		}
	}else{
		return redirect('/login');
	}

}
/*----------------------Artist testimonial Edit-------------------*/
public function edit_testimonial($testi_id){

	$testi_data =  Testimonial::where('id',$testi_id)->first();


	if(Auth::check()){
		if(Auth::user()->type=="Admin"){
			return redirect('admin_dashboard');
		}
		elseif (Auth::user()->type=="User") {
			return redirect('profile');
		}
		else{
			$artist =  Profile::where('EmailId',Auth::user()->email)->first();
			$artist_data['artist'] = $artist;
			$testi_data =  Testimonial::where('id',$testi_id)
			->join('profiles','profiles.ProfileId','=','testimonials.by_profile_id')
			->first();
			$artist_data['testi_data'] = $testi_data;
				//dd($artist_data['testi_data']);
				//$artist_data['artist'] = $artist;
			return view('frontend.artistDashboard.edit_testimonial',$artist_data);
		}
	}
	else{
		return redirect('/login');
	}
}
public function post_edit_testimonial(Request $request,$testi_id){
	if(Auth::check()){
		$data = $request->all();
			//dd($data);
		$validator = Validator::make($data,
			array(
				'message' =>'required'
				)
			);
		if($validator->fails()){
			return redirect( url()->previous())
			->withErrors($validator)
			->withInput();
		}else{

			if(DB::table('testimonials')->where('id', $testi_id)->update(['message' => $request->message])){
				return redirect('/edit_testimonial/'.$testi_id)->with('success',"successfully updated ");
			}
			else
			{
				return redirect('/edit_testimonial/'.$testi_id)->with('success',"No change here,successfully updated");
			}

		}
	}else{
		return redirect('/login');
	}

}
/*----------------------Artist testimonial Delete-------------------*/
public function delete_testimonial($testi_id){
	if(Auth::check()){
			//$data = $request->all();
		if(DB::table('testimonials')->where('id', $testi_id)->delete()){
			return redirect('/view_testimonial')->with('success',"successfully deleted ");
		}else{
			return redirect('/view_testimonial')->with('error',"delete not successfully");
		}
	}else{
		return redirect('/login');
	}

}
/*--------------------video comment by user ------------------------*/
public function post_video_testimonial(Request $request){
	$data = $request->all();
		//dd($data);
	if(Auth::check()){
		
		$data = $request->all();
		$validator = Validator::make($data,
			array(
				'message' =>'required'
				)
			);
		if($validator->fails()){
			return redirect( url()->previous())
			->withErrors($validator)
			->withInput();
		}else{
			$user = \App\Profile::find($request->by_profile_id);
			$artist = \App\User::where('profile_id',$request->to_profile_id)->first();
			if(!is_null($artist)){
				if($artist->is_account_active == 1){
					$testimonial =   new Testimonial();
					$testimonial->user_name = $user->Name;
					$testimonial->to_profile_id = $request->to_profile_id;
					$testimonial->video_id = $request->video_id;
					$testimonial->Email = $user->EmailId;
					$testimonial->AdminApproval = 0;
					$censor = new CensorWords;
					$string = $censor->censorString($request->message);
					$testimonial->message = $string['clean'];
					if($testimonial->save()){
						return redirect( url()->previous())->with('success','Your Comment is Under review');
					}
				}else{
					return redirect( url()->previous())->with('error','Artist is Deactivated');
				}
			}else{
				return redirect('/view-all-artist')->with('error','Artist Account has been deleted');
			}
			
		}
	}
	
	else{
		return redirect('login')->with('login_error','Please Login to Comment');
	}
}
/*------------------------------Success payment-------------------------------*/
public function success_payment() {
	return view('frontend.success_payment');
}
/*------------------------------Success request-------------------------------*/
public function success_request() {
	return view('frontend.success_request');
}
/*------------------------------Success Register-------------------------------*/
public function success_register() {
	return view('frontend.success_register');
}
/*------------------------------Add Price-------------------------------*/
public function add_price() {
	if(Auth::check()){
		if(Auth::user()->type=="Admin"){
			return redirect('admin_dashboard');
		}
		elseif (Auth::user()->type=="User") {
			return redirect('profile');
		}
		else{
			$artist =  Profile::where('EmailId',Auth::user()->email)->first();
			$artist_data['artist'] = $artist;
			$artist_data['baseurl'] = "http://videorequestlive.com/";
			return view('frontend.artistDashboard.video_price',$artist_data);
		}
	}
	else{
		return redirect('/login');
	}
}
public function post_add_price(Request $request){
	$data = $request->all();
	$validator = Validator::make(
		array(
			'video_price' =>$request->video_price,
			),
		array(
			'video_price' =>'required|integer',
			)
		);
	if($validator->fails())
	{
		return redirect('/addPrice')
		->withErrors($validator)
		->withInput();
	}
	else
	{
		$id=Auth::user()->profile_id;
		if($request->video_price <='500' and $request->video_price >='1')
		{
			if(DB::table('profiles')->where('ProfileId', $id)->update(['VideoPrice' => $request->video_price])){
				return redirect('addPrice')->with('success',"successfully updated ");
			}
			else
			{
				return redirect('addPrice')->with('success',"successfully updated ");
			}
		}
		else{
			return redirect('addPrice')->with('error','Price must be between $1 to $500');
		}
	}
}

/*------------------------------Add Timestamp-------------------------------*/
public function turnaround_time() {
	if(Auth::check()){
		if(Auth::user()->type=="Admin"){
			return redirect('admin_dashboard');
		}
		elseif (Auth::user()->type=="User") {
			return redirect('profile');
		}
		else{
			$artist =  Profile::where('EmailId',Auth::user()->email)->first();
			$artist_data['artist'] = $artist;
			return view('frontend.artistDashboard.timestamp',$artist_data);
		}
	}
	else{
		return redirect('/login');
	}
}
public function post_turnaround_time(Request $request){
	$data = $request->all();
	$messages = [
	'timestamp.required' => 'The fulfillment duration field is required.',
	'timestamp.integer' => 'The fulfillment duration must be an integer.',
	];
	$validator = Validator::make(
		array(
			'timestamp' =>$request->timestamp,
			),
		array(
			'timestamp' =>'required|integer',
			),$messages
		);
	if($validator->fails())
	{
		return redirect('turnaround_time')
		->withErrors($validator)
		->withInput();
	}
	else
	{
		$id=Auth::user()->profile_id;
		$artist = \App\Profile::find($id);
		$artist->timestamp = $request->timestamp;

		if($artist->save()){
			return redirect('turnaround_time')->with('success',"successfully updated ");
		}
		else{
			return redirect('turnaround_time')->with('error','Oops..! Something went go Wrong');
		}
	}
}
/*------------------------------Media CSs-------------------------------*/
public function get_media(Request $request) {
	if(Auth::check()){
		if(Auth::user()->type=="Admin"){
			return redirect('admin_dashboard');
		}
		elseif (Auth::user()->type=="User") {
			return redirect('profile');
		}
		else{
			$profileData =  Profile::where('EmailId',Auth::user()->email)->first();
			$text_color = DB::table('profiles')->where('EmailId', Auth::user()->email)->first();
			$artistData['profileData'] = $profileData;
			$artistData['text_color'] = $text_color;
			return view('frontend.artistDashboard.media',$artistData);
		}
	}
	else{
		return redirect('/login');
	}
}
public function media(Request $request) {
	if(DB::table('profiles')->
		where('EmailId', Auth::user()->email)->
		update(array('text_color' => $request->text_color ,'title_color' => $request->title_color,'name_heading_size' => $request->name_heading_size,'description_color' => $request->description_color,'custom_css' => $request->custom_css))){
		return redirect('media')->with('success','Successfully Updated');;
}
}
/*------------------------------bank details-------------------------------*/
public function get_bank_details(Request $request) {
	if(Auth::check()){
		if(Auth::user()->type=="Admin"){
			return redirect('admin_dashboard');
		}
		elseif (Auth::user()->type=="User") {
			return redirect('profile');
		}
		else{
			$profileData =  Profile::where('EmailId',Auth::user()->email)->first();
		//dd($profileData);
			return view('frontend.artistDashboard.update_bank',['profileData'=>$profileData]);
		}
	}
	else{
		return redirect('/login');
	}
}

public function bank_details(Request $request){
	$validator = Validator::make(
		array(
			'routing_number' =>$request->routing_number,
			'account_number' =>$request->account_number,
			'confirm_account_number' =>$request->confirm_account_number,
			'ssn_number' =>$request->ssn_number,
			'pin' =>$request->pin,
			'id_pic' =>$request->file('id_pic')
			),
		array(
			'routing_number' =>'required|min:9|max:9',
			'account_number' =>'required|min:12|max:12',
			'confirm_account_number' =>'required|same:account_number',
			'ssn_number' =>'required|min:4|max:4',
			'pin' =>'required',
			'id_pic' =>'required|mimes:jpeg,png',
			
			));
	if($validator->fails())
	{
		return redirect('bank_details')
		->withErrors($validator)
		->withInput();
	}
	elseif(Substr($request->pin,-4) !== $request->ssn_number ){
		return redirect('bank_details')->with('error','Personal id number and ssn number must match');
	}
	else
	{
		
		$id  = Auth::user()->profile_id;
		$artist_bank_detail = Profile::find($id);

		if($artist_bank_detail->is_bank_updated == 1){
			if($artist_bank_detail->stripe_account_id == 0){
				return redirect('bank_details')->with('error','You can not update Because your Account Is not Created yet !');
			}
		}
		else{
			if($artist_bank_detail->is_bank_updated == 0){
				
				$artist_bank_detail->is_bank_updated= 1;
			}
			else{
				$artist_bank_detail->is_bank_updated= 2;
			}
			
			$artist_bank_detail->routing_number = $request->routing_number;
			$artist_bank_detail->account_number= $request->account_number;
			$artist_bank_detail->ssn_number= $request->ssn_number;
			$artist_bank_detail->pin= $request->pin;
			
			$id_pic_path = "images/Artist/id/".date('U').'.jpg';
			$artist_bank_detail->id_pic= $id_pic_path;
			$destinationPath = base_path() . '/public/images/Artist/id/';
			$request->file('id_pic')->move($destinationPath, $id_pic_path);
			
			if($artist_bank_detail->save()){
				return redirect('bank_details')->with('success','Successfully Updated! ');
				
			}

		}
	}
	
}

/*--------------------------------Reset----------------------------------*/
public function forget_password_verify($email) {
	$email = decrypt($email);
	$result = DB::table('users')->where('auth_reset_pass', $email)->first();
	if(count($result)>0){
		return redirect('reset')->with('email',$result->email);
	}
	else{
		return redirect('login');
	}
}
/*-------------------------------------Reset--------------------------*/
public function password_reset() {
	if(Auth::check()){
		if(Auth::user()->type=="Artist"){
			return redirect('/');
		}
		elseif (Auth::user()->type=="User") {
			return redirect('profile');
		}
		else{
			return redirect('admin_dashboard');
		}
	}
	else{
		return view('frontend.reset');
	}
}
public function post_password_reset(Request $request) {
	$data = $request->all();
	$messages = [
	'required' => 'The :attribute field is required.',
	'password.regex' => ' Use at least one letter, one numeral & one special character',
	'password.min' => 'Password must be at least 8 character',
	];
	$validator = Validator::make($data,
		array(
			'password' =>'required|min:8|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$/',
			'c_password' =>'required|same:password',
			),$messages
		);
	if($validator->fails()){
		return redirect('reset')
		->withErrors($validator)
		->withInput();
	}else{
		$pass=$request->password;
		$enc_pass=Hash::make($pass);
		if(DB::table('users')->where('email', $request->email)->update(['password' => $enc_pass])){
			$auth_pass_re='';
			DB::table('users')->where('email', $request->email)->update(['auth_reset_pass' => $auth_pass_re]);
			Session::flush();
			return redirect('/login')->with('login_error',"You have successfully reset your Password");
		}
	}
}
/*----------------------------Forget Password-----------------------------------*/
public function get_forget_pass() {
	if(Auth::check()){
		if(Auth::user()->type=="Artist"){
			return redirect('/');
		}
		elseif (Auth::user()->type=="User") {
			return redirect('profile');
		}
		else{
			return redirect('admin_dashboard');
		}
	}
	else{
		return view('frontend.forget');
	}
}
public function forgetpass(Request $request){
	$data = $request->all();
	$messages = [
	'required' => 'The :attribute field is required.',

	];
	$validator = Validator::make($data,
		array(
			'email' =>'required'
			),$messages
		);
	if($validator->fails()){
		return redirect('forget_pass')
		->withErrors($validator)
		->withInput();
	}else{
		$email = DB::table('profiles')->where('EmailId',$request->email)->first();
		$auth_pass = str_random(15);
		$confirmation_code['confirmation_code'] = encrypt($auth_pass);
		DB::table('users')->where('email', $request->email)->update(array('auth_reset_pass' => $auth_pass));
		if(count($email) > 0){
			Mail::send('emails.forget_reminder',$confirmation_code, function ($message) use ($request) {
				$message->from('noreply@videorequestline.com', 'Reset Password');
				$message->to($request->email,'rajesh');
				$message->subject('Reset Password');
			});
			return redirect('login')->with('login_error',"Please Check Your Email to get Password");
		}
		else{
			return redirect('forget_pass')->with('forget_error',"Unregistered Email");
		}
	}
}
/*-----------------------Artist Registration------------------------------*/
public function artist_register() {
	if(Auth::check()){
		if(Auth::user()->type=="Artist"){
			return redirect('/');
		}
		elseif (Auth::user()->type=="User") {
			return redirect('profile');
		}
		else{
			return redirect('admin_dashboard');
		}
	}
	else{
		return view('frontend.artist_registration');
	}
}
public function register(Request $request){
	$messages = [
	'required' => 'The :attribute field is required.',
	'confirmpassword.required'=> 'The Confirm password field is required.',
	'username.regex' => 'Use valid User name (as xyz or xyz1)',
	'username.required' => 'The Artist name field is required',
	// 'phone.regex' => 'Use valid Phone No (as 111-111-1111)',
	'artistPassword.regex' => ' Use at least one letter, one numeral & one special character',
	'profile.required' => 'The profile image field is required',
	'username.unique'=> 'User name has already been taken. Please enter another name',
	];
	$validator = Validator::make(
		array(
			'username' =>$request->username,
			'artistEmail' =>$request->artistEmail,
			'artistPassword' =>$request->artistPassword,
			'confirmpassword' =>$request->confirmpassword,
			'date_of_birth' =>$request->date_ofbirth,
			'phone' =>$request->phone,
			'gender' =>$request->gender,
			'profile' =>$request->file('profile'),
			),
		array(
			'username' =>'required|regex:/^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-0-9-, ])*$/|unique:users,user_name',
			'artistEmail' =>'required|email|unique:users,email',
			'artistPassword' =>'required|min:8|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$/',
			'confirmpassword' =>'required|same:artistPassword',
			'date_of_birth' =>'required',
			// 'year' =>'required',
			// 'month' =>'required',
			// 'day' =>'required',
			'phone' =>'required',
			'gender' =>'required',
			'profile' => 'image',
			),$messages
		);
	if($validator->fails())
	{
		return redirect('artist_register')
		->withErrors($validator)
		->withInput();
	}
	else
	{

		
		$email = DB::table('profiles')->where('EmailId',$request->email)->first();
		$name= DB::table('profiles')->where('Name',$request->username)->first();
		if(count($email) > 0){
			return redirect('artist_register')->with('register_error',"Email Already Exist");
		}else{
			$users = new User();
			$Profile = new Profile();
			$is_account_active=0;
			$is_email_active=0;
			$type='Artist';
			$users->user_name= $request->username;
			$users->email= $request->artistEmail;
			$users->password= Hash::make($request->artistPassword);
			$users->remember_token = $request->_token;
			$users->is_account_active = $is_account_active;
			$users->is_email_active = $is_email_active;
			$users->gender = $request->gender;
			$users->type = $type;
			// $dob=$request->month.'/'.$request->day.'/'.$request->year;
			// $dob=$request->date_ofbirth;
			//dd($dob);
			$users->date_of_birth = $request->date_ofbirth;
			$users->phone_no = $request->phone;
			$Profile->Name= $request->username;
			$Profile->EmailId= $request->artistEmail;
			$Profile->Type = $type;
			$Profile->Gender = $request->gender;
			$Profile->DateOfBirth = $request->date_ofbirth;
			$Profile->MobileNo = $request->phone;
			$Profile->timestamp = 15;
			$Profile->Zip = " ";

			if($request->profile ==""){
				$profile_path="images/Artist/default-artist.png";
				$Profile->profile_path= $profile_path;
			}
			else{
				$file = $request->file('profile');
				$filename = $file->getClientOriginalName();
				$extension = $file->getClientOriginalExtension();
				$profile_path = "images/Artist/".date('U').'.jpg';
				$Profile->profile_path= $profile_path;
				$destinationPath = base_path() . '/public/images/Artist/';
				$request->file('profile')->move($destinationPath, $profile_path);
			}
			$Profile->profile_url= strtolower($request->username);
			$Profile->BannerImg ="images/vrl_bg.jpg";
			$Profile->header_image ="/images/default_header.jpg";
			$Profile->video_background ="images/vrl_bg.jpg";
			$Profile->VideoPrice =30;
			$Profile->save();
			$profile_id = $Profile->ProfileId;
			$users->profile_id = $profile_id;
			$auth_pass = str_random(15);
			$users->auth_pass = $auth_pass;
			$confirmation_code['confirmation_code'] = encrypt($auth_pass);
			if($users->save()){
				Mail::send('emails.reminder', $confirmation_code, function ($message) use ($request) {
					$message->from('noreply@videorequestline.com', 'Registration Confirmation');
					$message->to($request->artistEmail, $request->username);
					$message->subject('Email Confirmation');
				});
				return redirect('success_register');
				//return redirect('artist_register')->with('success','Successfully Registered');
			}
			else{
				return redirect('artist_register')->with('register_error',"Oops..!Something went wrong");
			}
		}
	}
}
/*----------------------------Artist and User Login-------------------------------------*/
public function AllLogin() {
	if(Auth::check()){
		if(Auth::user()->type=="Admin"){
			return redirect('admin_dashboard');
		}
		elseif (Auth::user()->type=="Artist") {
			return redirect('/');
		}
		elseif (Auth::user()->type=="User") {
			return redirect('/profile');
		}

	}
	else
	{
		$signup_data = DB::table('setting')->select('status')->where('name','=','signup')->first();
		$data['signup_data']=$signup_data;
		return view('frontend.login',$data);
	}
}
public function post_allLogin(Request $request){
	//require(app_path().'/recaptcha/src/autoload.php');
	//$secret = '6LdERAwUAAAAAHE5dEGFwUVpZOFq8kKTEgjE2EPo';
	//$recaptcha = new \ReCaptcha\ReCaptcha($secret);
	//$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
	// if (!$resp->isSuccess()){
	if(0){

		return redirect('login')->with('login_error',"Invalid ReCaptcha.");
	}
	else{

		$messages = [
		'required' => 'The :attribute field is required.',
		'password.min' => 'Password must be at least 8 characters',
		];
		$validator = Validator::make(
			array(
				'email' =>$request->email,
				'password' =>$request->password
				),
			array(
				'email' =>'required|email',
				'password' =>'required|min:8'
				),$messages
			);

		if ($validator->fails()) {
			return redirect('/login')
			->withErrors($validator)
			->withInput();

		}
		else
		{
			$email=$request->email;
			$password=$request->password;
			$is_email_active = User::is_email_active($email);
			$is_account_active = User::is_account_active($email);
			if($is_email_active == "0"){
				return redirect('login')->with('login_error',"'You need to confirm your account. We have sent you an activation code, please check your email.'");
			}
			elseif ($is_account_active == "0") {
				return redirect('login')->with('login_error',"Your Account is deactivated.");
			}
			else{
				$login_result = User::where('email',$email)->first();
				if(count($login_result)>0){
					$user_type = $login_result->type;
					if($user_type=='Artist'){
						$user = array('email' =>$email,'password' =>$password);
						if(Auth::attempt($user)){
							Auth::attempt($user);
							Session::put('email',$email);
							Session::put('password',$password);
							return redirect('/Dashboard');
						}
						else{
							return redirect('login')->with('login_error',"Invalid email or password");
						}
					}
					else if($user_type=='User'){

						$user = array('email' =>$email,'password' =>$password);

						if(Auth::attempt($user)){
							Auth::attempt($user);
							Session::put('email',$email);
							Session::put('password',$password);
							return redirect('/user_video');
						}
						else{
							return redirect('login')->with('login_error',"Invalid email or password");
						}

					}else {

						return redirect('login')->with('login_error',"Invalid email or password");
					}
				}
				else{
					return redirect('login')->with('login_error',"Invalid email or password");
				}
			}
		}
	}
}
/*-----------------------------------Artist Login-------------------------------------*/
public function login() {
	if(Auth::check()){
		if(Auth::user()->type=="Artist"){
			return redirect('/');
		}
		elseif (Auth::user()->type=="User") {
			return redirect('profile');
		}
		else{
			return redirect('admin_dashboard');
		}
	}
	else{
		return view('frontend.login');
	}
}
public function artist_login(Request $request){
	$validator = Validator::make(
		array(
			'email' =>$request->email,
			'password' =>$request->password
			),
		array(
			'email' =>'required|email',
			'password' =>'required|min:8|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$/'
			)
		);
	if($validator->fails())
	{
		return redirect('artist_login')
		->withErrors($validator)
		->withInput();
	}
	else
	{
		$email=$request->email;
		$password=$request->password;
		$is_email_active = User::is_email_active($email);
		$is_account_active = User::is_account_active($email);
		if($is_email_active == "0"){
			return redirect('artist_login')->with('login_error',"'You need to confirm your account. We have sent you an activation code, please check your email.'");
		}
		elseif ($is_account_active == "0") {
			return redirect('artist_login')->with('login_error',"Your Account is deactivated.");
		}
		else{
			$login_result = User::where('email',$email)->first();
			if(count($login_result)>0){
				$user_type = $login_result->type;
				if($user_type=='Artist'){
					$user = array('email' =>$email,'password' =>$password);
					if(Auth::attempt($user)){
						Auth::attempt($user);
						Session::put('name',Auth::user()->user_name);
						Session::put('email',Auth::user()->email);
						return redirect('/');
					}
					else{
						return redirect('artist_login')->with('login_error',"Invalid email or password");
					}
				}
				else{
					return redirect('artist_login')->with('login_error',"Invalid email or password");
				}
			}
			else{
				return redirect('artist_login')->with('login_error',"Invalid email or password");
			}
		}
	}
}
/*-----------------------------------Email Verification-----------------------------------*/
public function verify_email($auth_pass){
	if(Auth::check()){
		if(Auth::user()->type=="Artist"){
			return redirect('/');
		}
		elseif (Auth::user()->type=="User") {
			return redirect('profile');
		}
		else{
			return redirect('admin_dashboard');
		}
	}
	else{
		$auth_pass = decrypt($auth_pass);
		$result = DB::table('users')->where('auth_pass','=',$auth_pass);
		if(count($result)>0){
			if(User::where('auth_pass','=',$auth_pass)->update(array('is_email_active' => 1 ,'is_account_active' => 1,'auth_pass' => '' ))){
				Session::put('success',"Email Verified ! Now Login");
				return redirect('login');
			}
			else{
				Session::put('login_error',"Oops..! Something Went wrong");
				return redirect('login');
			}
		}
	}
}
public function verify_user_email($auth_pass){
	if(Auth::check()){
		if(Auth::user()->type=="Artist"){
			return redirect('/');
		}
		elseif (Auth::user()->type=="User") {
			return redirect('profile');
		}
		else{
			return redirect('admin_dashboard');
		}
	}
	else{
		$auth_pass = decrypt($auth_pass);
		$result = DB::table('users')->where('auth_pass','=',$auth_pass);
		if(count($result)>0){
			if(User::where('auth_pass','=',$auth_pass)->update(array('is_email_active' => 1 ,'is_account_active' => 1,'auth_pass' => '' ))){
				return redirect('UserLogin')->with('verify_email','verifying email success');
			}
			else{
				echo "Oops..! Something Went wrong";
			}
		}
	}
}
/*-----------------------------------Artist Dashboard-----------------------------------*/
public function video_requests(){
	if(Auth::check()){
		if(Auth::user()->type=="Admin"){
			return redirect('admin_dashboard');
		}
		elseif (Auth::user()->type=="User") {
			return redirect('profile');
		}
		else{
			$user =  User::where('email',Auth::user()->email)->first();
			$video_request = DB::table('requestvideos')->where('requestToProfileId',$user->profile_id)
			->where('RequestStatus','<>','Reject')
			//->where('is_active','=','1')
			->orderBy('VideoReqId',"desc")
			// ->paginate(5);
			->get();
		// dd($video_request);
			$image_path = DB::table('profiles')->where('EmailId', $user->email)->first();
			$artist_data = array();
			$artist_data['users'] = $user;
			$artist_data['video_requests'] = $video_request;
			$artist_data['image_paths'] = $image_path;
			$artist_data['current_date'] = $date=date('d-m-Y');

			return view('frontend.artistDashboard.video_requests',$artist_data);
		}
	}else{
		return redirect('/login');
	}
}
/*-----------------------------------Artist Panding Request-----------------------------------*/
public function panding_requests(){
	if(Auth::check()){
		if(Auth::user()->type=="Admin"){
			return redirect('admin_dashboard');
		}
		elseif (Auth::user()->type=="User") {
			return redirect('profile');
		}
		else{
			$user =  User::where('email',Auth::user()->email)->first();
			$panding_video_request = DB::table('requestvideos')->where('requestToProfileId',$user->profile_id)
			->where('RequestStatus','=','Pending')
			//->where('is_active','=','1')
			->orderBy('VideoReqId',"desc")
			->paginate(5);
			//dd($video_request);
			$image_path = DB::table('profiles')->where('EmailId', $user->email)->first();
			$artist_data = array();
			$artist_data['users'] = $user;
			$artist_data['video_requests'] = $panding_video_request;
			$artist_data['image_paths'] = $image_path;
			$artist_data['current_date'] = $date=date('d-m-Y');

			return view('frontend.artistDashboard.panding_video_requests',$artist_data);
		}
	}else{
		return redirect('/login');
	}
}
/*-----------------------------------Dashboard-------------------------------------*/
public function get_dashboard(){
	if(Auth::check()){
		if(Auth::user()->type=="Admin"){
			return redirect('admin_dashboard');
		}
		elseif (Auth::user()->type=="User") {
			return redirect('profile');
		}
		elseif (Auth::user()->type=="Artist"){
			$user =  User::where('email',Auth::user()->email)->first();
			//dd($user);
			$my_video = Video::where('ProfileId',Auth::user()->profile_id)->get();
			$my_delivered_video = DB::table('requested_videos')->where('uploadedby',Auth::user()->profile_id)->get();
			$deliver_videos = DB::table('requested_videos')->select('*')
			->join('profiles','profiles.ProfileId','=','requested_videos.uploadedby')
			->where('requested_videos.uploadedby','=',Auth::user()->profile_id)
			->get();
			$video_request = DB::table('requestvideos')->where('requestToProfileId',$user->profile_id)
			->where('RequestStatus','<>','Reject')->orderBy('created_at')->limit(5)->get();

			$panding_video_requests = DB::table('requestvideos')->where('requestToProfileId',$user->profile_id)
			->where('RequestStatus','=','Pending')->orderBy('created_at')->get();

			$image_path = DB::table('profiles')->where('EmailId', $user->email)->first();
			//$profileData =  Profile::where('EmailId',Auth::user()->email)->first();
			$artist_data = array();
			$artist_data['users'] = $user;
			$artist_data['my_videos'] = $my_video;
			$artist_data['my_delivered_videos'] = $my_delivered_video;
			$artist_data['video_requests'] = $video_request;
			$artist_data['panding_video_requests'] = $panding_video_requests;
			$artist_data['image_paths'] = $image_path;
			$artist_data['deliver_videos'] = $deliver_videos;
			//$artistData['profileData'] = $profileData;
			// dd($artist_data);
			return view('frontend.artistDashboard.dashboard',$artist_data);
		}
	}
	else{
		return redirect('/');
	}
}
/*-----------------------Artist Profile------------------------------*/
public function ArtistProfile(){
	if(Auth::check()){
		if(Auth::user()->type=="Admin"){
			return redirect('admin_dashboard');
		}
		elseif (Auth::user()->type=="User") {
			return redirect('profile');
		}
		else{
			return view('frontend.ArtistProfile');
		}
	}
	else{
		return redirect('/');
	}
}
/*-----------------------Artist uploads Video------------------------------*/
public function upload_video($id){
	if(Auth::check()){
		if(Auth::user()->type=="Admin"){
			return redirect('admin_dashboard');
		}
		elseif (Auth::user()->type=="User") {
			return redirect('profile');
		}
		else{
			$artist =  Profile::where('EmailId',Auth::user()->email)->first();
			$Requestor =  Profile::where('ProfileId',$id)->first();
			$artist_data['artist'] = $artist;
			$artist_data['requestors'] = $Requestor;
			$artist_data['baseurl'] = "http://videorequestlive.com/";
			return view('frontend.artistDashboard.upload_video',$artist_data);
		}
	}
	else{
		return redirect('/');
	}
}
/*-----------------------Artist Background upload------------------------------*/
public function upload_background(){
	if(Auth::check()){
		if(Auth::user()->type=="Admin"){
			return redirect('admin_dashboard');
		}
		elseif (Auth::user()->type=="User") {
			return redirect('profile');
		}
		else{
			$artist_data =  Profile::where('EmailId',Auth::user()->email)->first();
			return view('frontend.artistDashboard.upload_background',['artist_data'=>$artist_data]);
		}
	}
	else{
		return redirect('/login');
	}
}
public function upload_background_image(Request $request){
	if(Auth::check()){
		$artist_id =  User::where('profile_id',$request->profile_id)->first();
		//dd($artist_id);
		if($artist_id->is_account_active=='1')
		{
			$validator = Validator::make($request->all(),
				array(
					'background' => 'required|mimes:jpeg,png',
					)
				);
			if($validator->fails()){
				return redirect('/background_img')
				->withErrors($validator)
				->withInput();
			}else{
				$file = $_FILES["background"]['tmp_name'];
				list($width, $height) = getimagesize($file);
				if($width < "800" || $height < "424") {
					return redirect('/background_img')->with('error','image size must be above or equal to 800 x 424 pixels.');
				}else{
					$artist = Profile::find(Auth::user()->profile_id);
					if($request->file('background') != ""){
						$file = $request->file('background');
						$filename = $file->getClientOriginalName();
						$profile_path = "images/Artist/".$request->username.date('U').$filename;
						$destinationPath = base_path() . '/public/images/Artist/';
						$request->file('background')->move($destinationPath, $profile_path);
						$profile_path = "images/Artist/".$request->username.date('U').$filename;
						$artist->BannerImg = $profile_path;
					}
					if($artist->save()){
						
						return redirect('/background_img')->with('message','Successfully Updated!');
					}
				}
			}
		}else{
			Redirect::back()->with('new_token', csrf_token());
			echo "not active";
		}	
	}else{
		Auth::logout();
		return redirect('login');
	}
}
/*-----------------------Artist  video Background Img upload-----------------*/
public function upload_video_background(){
	if(Auth::check()){
		if(Auth::user()->type=="Admin"){
			return redirect('admin_dashboard');
		}
		elseif (Auth::user()->type=="User") {
			return redirect('profile');
		}
		else{
			$artist =  Profile::where('EmailId',Auth::user()->email)->first();
			return view('frontend.artistDashboard.upload_video_background',['artist'=>$artist]);
		}
	}
	else{
		return redirect('/login');
	}
}
public function uploadVideoBackground(Request $request){
	
	$validator = Validator::make($request->all(),
		array(
			'video_background' => 'required|mimes:jpeg,png',
			)
		);
	if($validator->fails())
	{
		return redirect('/upload_video_background')
		->withErrors($validator)
		->withInput();
	}
	else
	{
		$file = $_FILES["video_background"]['tmp_name'];
		list($width, $height) = getimagesize($file);
		if($width < "400" || $height < "400") {
			    //echo "Error : image size must be 180 x 70 pixels.";
			return redirect('/upload_video_background')->with('error','image size must be 400 x 400 pixels.');
			    //return redirect('my_slider')->withErrors('img_error','image size must be 180 x 70 pixels')->withInput();
		}else{
			$artist = Profile::find(Auth::user()->profile_id);
			if($request->file('video_background') != ""){
				$file = $request->file('video_background');
				$filename = $file->getClientOriginalName();
				$path = "images/Artist/".$request->username.date('U').$filename;
				$destinationPath = base_path() . '/public/images/Artist/';
				$request->file('video_background')->move($destinationPath, $path);
				$profile_path = "images/Artist/".$request->username.date('U').$filename;
				$artist->video_background = $path;
			}
			if($artist->save()){
				return redirect('/upload_video_background')->with('message','Successfully Updated!');
				
			}
		}
	}
}
/*-----------------------Artist  Header Img upload-----------------*/
public function artist_header_img(){
	if(Auth::check()){
		if(Auth::user()->type=="Admin"){
			return redirect('admin_dashboard');
		}
		elseif (Auth::user()->type=="User") {
			return redirect('profile');
		}
		else{
			$artist_data =  Profile::where('EmailId',Auth::user()->email)->first();
			return view('frontend.artistDashboard.artist_header_img',['artist_data'=>$artist_data]);
		}
	}
	else{
		return redirect('/login');
	}
}
public function update_artist_header_img(Request $request){
	$validator = Validator::make($request->all(),
		array(
			'header_img' => 'required|mimes:jpeg,png',
			)
		);
	if($validator->fails())
	{
		return redirect('/artist_header_img')
		->withErrors($validator)
		->withInput();
	}
	else
	{
		$file = $_FILES["header_img"]['tmp_name'];
		list($width, $height) = getimagesize($file);
		if($width < "400" || $height < "400") {
		    //echo "Error : image size must be 180 x 70 pixels.";
			return redirect('/artist_header_img')->with('error','image size must be 400 x 400 pixels.');

		}else{
			$artist = Profile::find(Auth::user()->profile_id);
			if($request->file('header_img') != ""){
				$file = $request->file('header_img');
				$filename = $file->getClientOriginalName();
				$path = "/images/Artist/".$request->username.date('U').$filename;
				$destinationPath = base_path() . '/public/images/Artist/';
				$request->file('header_img')->move($destinationPath, $path);
				$profile_path = "images/Artist/".$request->username.date('U').$filename;
				$artist->header_image = $path;
			}
		}
		if($artist->save()){
			return redirect('/artist_header_img')->with('message','Successfully Updated!');
		}
	}
}
/*-----------------------Artist Slider-----------------------------*/
public function my_slider(){
	if(Auth::check()){
		if(Auth::user()->type=="Admin"){
			return redirect('admin_dashboard');
		}
		elseif (Auth::user()->type=="User") {
			return redirect('profile');
		}
		else{
			$artist =  Profile::where('EmailId',Auth::user()->email)->first();
			$slider = Slider::where('artist_id',Auth::user()->profile_id)->first();
			$artist_data['artist'] = $artist;
			$artist_data['slider'] = $slider;
			if(count($slider)>0){
				return view('frontend.artistDashboard.edit_slider',$artist_data);
			}
			else{
				return view('frontend.artistDashboard.slider',$artist_data);
			}
		}
	}
	else{
		return redirect('/login');
	}
}
/*----------------------------------------create Slider------------------------------------*/
public function create_slider(Request $request){
	$data = $request->all();
	//dd($data);
	$validator = Validator::make($data,
		array(
			'slider_title' =>'required|max:100',
			'slider_description' =>'required',
			'slider_img' => 'required | mimes:jpeg,png'
			)
		);
	if($validator->fails()){
		return redirect('my_slider')
		->withErrors($validator)
		->withInput();
	}
	else{
		//
		$file = $_FILES["slider_img"]['tmp_name'];
		list($width, $height) = getimagesize($file);
		if($width < "400" || $height < "400") {
		    //echo "Error : image size must be 180 x 70 pixels.";
			return redirect('my_slider')->with('success','image size must be 400 x 400 pixels.');
		    //return redirect('my_slider')->withErrors('img_error','image size must be 180 x 70 pixels')->withInput();
		}else{
			$slider = new Slider();
			$slider->slider_visibility = 0;
			$slider->slider_title = $request->slider_title;
			$slider->slider_description = $request->slider_description;
			$slider->artist_id = Auth::user()->profile_id;
			if($request->file('slider_img') != ""){
				$file = $request->file('slider_img');
				$filename = $file->getClientOriginalName();
				$slider_path = "images/Sliders/".date('U').'.jpeg';
				$destinationPath = base_path() . '/public/images/Sliders/';
				$request->file('slider_img')->move($destinationPath, $slider_path);
				$slider->slider_path = $slider_path;
			}
			if($slider->save()){
				return redirect('my_slider')->with('success','Slider Uploaded Successfully');
			}
		}	
	}
}
public function update_my_slider(Request $request){
	$data = $request->all();
	//dd($data);
	$validator = Validator::make($data,
		array(
			'slider_title' =>'required|max:100',
			'slider_description' =>'required',
			'slider' =>  'image'
			)
		);
	if($validator->fails()){
		return redirect('my_slider')
		->withErrors($validator)
		->withInput();
	}
	else{
		if ($request->hasFile('slider')) {
			$file = $_FILES["slider"]['tmp_name'];
			list($width, $height) = getimagesize($file);
			if($width < "400" || $height < "400") {
				return redirect('my_slider')->with('success','image size must be 400 x 400 pixels.');
			}else{
				$slider = Slider::where('artist_id',Auth::user()->profile_id)->first();
				$slider->slider_title = $request->slider_title;
				$slider->slider_description = $request->slider_description;
				if($request->file('slider') != ""){
					$file = $request->file('slider');
					$filename = $file->getClientOriginalName();
					$slider_path = "images/Sliders/".date('U').'.jpeg';
					$destinationPath = base_path() . '/public/images/Sliders/';
					$request->file('slider')->move($destinationPath, $slider_path);
					$slider->slider_path = $slider_path;
				}
				if($slider->save()){
					return redirect('my_slider')->with('success','Successfully Updated!');
				}
			}
		}else{
			$slider = Slider::where('artist_id',Auth::user()->profile_id)->first();
			$slider->slider_title = $request->slider_title;
			$slider->slider_description = $request->slider_description;
			if($slider->save()){
				return redirect('my_slider')->with('success','Successfully Updated!');
			}
		}
		//dd($data);
	}
}
/*-----------------------------Artist Change password--------------------------*/
public function get_change_password() {
	if(Auth::check()){
		if(Auth::user()->type=="Admin"){
			return redirect('admin_dashboard');
		}
		elseif (Auth::user()->type=="User") {
			return redirect('profile');
		}
		else{
			$profileData =  Profile::where('EmailId',Auth::user()->email)->first();
			$artistData['profileData'] = $profileData;	
			$artistData['baseurl'] = "http://videorequestlive.com/";
			return view("frontend.artistDashboard.change-password",$artistData);
		}
	}
	else{
		return view('frontend.login');
	}
}
public function change_password(Request $request){
	$messages = [
	'required' => 'The :attribute field is required.',
	'new_password.regex' => ' Use at least one letter, one numeral & one special character',
	'old_password.regex' => ' Use at least one letter, one numeral & one special character',
	'new_password.min' => ' New password should be at least 8 characters ',
	'old_password.min' => ' Old password should be at least 8 characters',
	'confirm_password.min' => ' Confirm password should be at least 8 characters',
	];
	$validator = Validator::make(
		array(
			'old_password' =>$request->old_password,
			'new_password' =>$request->new_password,
			'confirm_password' =>$request->confirm_password
			),
		array(
			'old_password' =>'required|min:8|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$/',
			'new_password' =>'required|min:8|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$/',
			'confirm_password' =>'required|min:8|same:new_password'
			),$messages
		);
	if($validator->fails())
	{
		return redirect('change-password')
		->withErrors($validator)
		->withInput();
	}
	else
	{
		$user = User::find(Auth::user()->user_id);
		$old_password=$request->old_password;
		$new_password=$request->new_password;
		if(Hash::check($old_password, $user->getAuthPassword())){
			$user->password = Hash::make($new_password);
			if($user->save()){
				Session::put('password',$new_password);
				return redirect('change-password')->with('success',"Password Changed Successfully");
			}
		}
		else{
			return redirect('change-password')->with('error',"Invalid  password");
		}
	}
}
/*-----------------------------------notifications-------------------------------*/
public function notification() {
	if(Auth::check()){
		if(Auth::user()->type=="Admin"){
			return redirect('admin_dashboard');
		}
		elseif (Auth::user()->type=="User") {
			return redirect('profile');
		}
		else{
			$user =  User::where('email',Auth::user()->email)->first();
			$notification = DB::table('notification')->select('notification.*','profiles.*')
			->join('profiles','profiles.ProfileId','=','notification.send_to')->get();
			$artist_data['users'] = $user;
			$artist_data['notifications'] = $notification;
			$artist_data['baseurl'] = "http://videorequestlive.com/";
// print_r($artist_data);
			return view('frontend.artistDashboard.notifications',$artist_data);
		}
	}
	else{
		return redirect("/");
	}
}
/*-----------------------------------Artist profile Update-------------------------------------*/
public function ProfileUpdate(){
	if(Auth::check()){
		if(Auth::user()->type=="Admin"){
			return redirect('admin_dashboard');
		}
		elseif (Auth::user()->type=="User") {
			return redirect('profile');
		}
		else{
			$userData =  User::where('email',Auth::user()->email)->first();
			$profileData =  Profile::where('EmailId',Auth::user()->email)->first();
			$artistData['userData'] = $userData;
			$artistData['profileData'] = $profileData;
			$artistData['baseurl'] = "http://videorequestlive.com/";
			return view('frontend.artistDashboard.ProfileUpdate',$artistData);
		}
	}
	else{
		return redirect('/login');
	}
}
public function ProfileUpdateForm(Request $request){
	$data = $request->all();
	$messages = [
	'required' => 'The :attribute field is required.',
	'phone.regex' => ' Phone Should contain Numbers only',
	'username.regex' => 'Use valid User name (as xyz or xyz1)',

	];
	$validator = Validator::make($data,
		array(
			'username' =>'required|regex:/^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-0-9-, ])*$/',
			//'year' =>'required',
			//'month' =>'required',
			//'day' =>'required',
			// 'date_ofbirth' =>'required',
			'phone' => 'required|regex:/[0-9]/|digits:10',
			'nickName'=>'regex:/^[\pL\s\-]+$/u',
			'address' =>'required',
			'city' =>'required',
			'state' =>'required',
			'country' =>'required',
			//'description' =>'required|min:400',
			//'zip'=>'required|digits:6',
			'zip'=>'required',
			'profile' => 'mimes:jpeg,png',
			),$messages
		);
	if($validator->fails()){
		return redirect('ProfileUpdate')
		->withErrors($validator)
		->withInput();
	}else{

		$artist = Profile::find($request->ProfileId);
		$artist->Name = $request->username;
		// $dob=$request->profile_date_ofbirth;

		if($request->date_ofbirth != ''){
			$dob=$request->date_ofbirth;
		}else{
			$dob=$request->profile_date_ofbirth1;
		}

		$artist->DateOfBirth = $dob;
		$artist->MobileNo = $request->phone;
		$artist->NickName = $request->nickName;
		$artist->Address = $request->address;
		$artist->City = $request->city;
		$artist->State = $request->state;
		$artist->profile_description = $request->description;
		if($request->file('profile') != ""){
			

			$file = $_FILES["profile"]['tmp_name'];
			list($width, $height) = getimagesize($file);
			if($width < "400" || $height < "400") {
			    //echo "Error : image size must be 180 x 70 pixels.";
				return redirect('ProfileUpdate')->with('success','image size must be 400 x 400 pixels.');
			    //return redirect('my_slider')->withErrors('img_error','image size must be 180 x 70 pixels')->withInput();
			}else{
				$file = $request->file('profile');
				$filename = $file->getClientOriginalName();
				$profile_path = "images/Artist/". date('U').'.jpg';
				$destinationPath = base_path() . '/public/images/Artist/';
				$request->file('profile')->move($destinationPath, $profile_path);
				$artist->profile_path = $profile_path;

			}
		}
		$artist->country = $request->country;
		$artist->Zip = $request->zip;
		$artist->Gender=$request->gender;
		if($artist->save()) {
			return redirect('ProfileUpdate')->with('success', 'Successfully Updated!');
		}else{
			return redirect('ProfileUpdate')->with('error', 'Successfully Updated!');
		}
	}
}
/*---------------------------------approve Video request----------------------------------*/
public function approve_request($id){
	
	$requestvideo = Requestvideo::find($id);
	$artist =  Profile::find(Auth::user()->profile_id);
	$data['artist']=$artist->Name;
	$data['user']=$requestvideo->Name;
	$data['price']=$artist->VideoPrice;
	$data['complitionDate']=$requestvideo->complitionDate;
	$requestvideo->RequestStatus = "Approved";
	$requestvideo->approval_date = date('d-m-Y');
	$user_email = $requestvideo->requestor_email;
	if($requestvideo->is_active== 0){
		return redirect(url()->previous())->with('success','Request has been rejected previously.');
	}else{
		if($requestvideo->save()){
			$user = $user_email;
			Mail::send('emails.video_response', $data, function ($message) use ($user) {
				$message->from('noreply@videorequestline.com','VRL');
				$message->to($user,'User');
				$message->cc('noreply@videorequestline.com', 'Super Administrator');
				$message->subject('Your Request have been Approved Successfully by Artist');
			});


			//$passphrase = '12345';
			$user_detail=DB::table('users')->where('profile_id','=',$requestvideo->requestByProfileId)->first();
			$deviceToken =$user_detail->device_token;
			$deviceType =$user_detail->device_type;
			/*if($deviceType=='iphone' && $deviceToken!=''){
                $passphrase = '12345';
                
                if($deviceToken!=''){
                    $ctx = stream_context_create();
                    
                    $test = stream_context_set_option($ctx, 'ssl', 'local_cert', 'VRL.pem');
                    
                    stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
                    
                    $fp = stream_socket_client(
                     'ssl://gateway.sandbox.push.apple.com:2195', $err,
                     $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
                    
                    $body['aps'] = array(
                     'alert' => 'Approved successfully video request by '.$artist->Name ,
                     'sound' => 'default',
                     'badge' => 1,
                     );
                    
                    $payload = json_encode($body);
                    
                    $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
                    
                    $result = fwrite($fp, $msg, strlen($msg));
                    fclose($fp);
					return redirect(url()->previous())->with('success','Approved successfully'); 
                }else{
                    $successmsg="Device token not found";
                    return redirect(url()->previous())->with('success','Approved successfully');
                    
                }
            }*/
            /*if($deviceType=='android' && $deviceToken!=''){
        
                $to=$deviceToken;
                $title="Video Request";//  
                $message='Approved successfully video request by '.$artist->Name;
                    define( 'API_ACCESS_KEY','AAAAUezx5KE:APA91bHdeF33VnwpVxrzlK0umno6Cb8sgTDlwmyQITcz9-3_PBBY-RXETQias398AHVqkq45-_Xu0BRopNREelz3n9YBEhI3SkKSo8myUfThTkV4dYOkGdcolMBFpdXHGSVdYnnz9SPXplFAsI7CnYcf54-G8i3bjQ');
                    $registrationIds = array($to);
                    $msg = array
                    (
                        'message' => $message,
                        'title' => $title,
                        'vibrate' => 1,
                        'sound' => 1
                        );
                    $fields = array
                    (
                        'registration_ids' => $registrationIds,
                        'data' => $msg
                        );

                    $headers = array
                    (
                        'Authorization: key='.API_ACCESS_KEY,
                        'Content-Type: application/json'
                        );

                    $ch = curl_init();
                    curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
                    curl_setopt( $ch,CURLOPT_POST, true );
                    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
                    $result = curl_exec($ch );
                    curl_close( $ch );
                            
                     return redirect(url()->previous())->with('success','Approved successfully');
                 }*/

                 return redirect(url()->previous())->with('success','Approved successfully');
             }
             else{
             	return redirect('Dashboard')->with('error','Oops ! Something is wrong');
             }
         }
     }
     /*---------------------------------Reject Video request----------------------------------*/
     public function reject_request($id){

     	$requestvideo = Requestvideo::find($id);
     	$artist =  Profile::find(Auth::user()->profile_id);
     	$data['artist']=$artist->Name;
     	$data['user']=$requestvideo->Name;
     	$data['price']=$artist->VideoPrice;
     	$data['complitionDate']=$requestvideo->complitionDate;
     	$requestvideo->RequestStatus = "Reject";
     	$requestvideo->is_refunded = 1;
     	$requestvideo->is_active= 0;
		//$requestvideo->ReqVideoPrice = $artist->VideoPrice;
     	$user_email = $requestvideo->requestor_email;
     	if($requestvideo->is_active== 1){
     		return redirect(url()->previous())->with('success','Request has been approved previously.');
     	}else{
     		if($requestvideo->save()){
     			$payment=\App\Payment::where('video_request_id',$id)->where('status','succeeded')->first();
     			if(!is_null($payment)){
     				\Stripe\Stripe::setApiKey("sk_test_CtVU3fFCOkPs7AbQDLLJmU1n");
     				$ch = \Stripe\Charge::retrieve($payment->charge_id);
     				if(!$ch->refunded){
     					$re = $ch->refund();
     					$payment->is_refunded=1;
     					$payment->save();
     				}
     			}
     			


     			$user = $user_email;
     			Mail::send('emails.video_request_reject', $data, function ($message) use ($user) {
     				$message->from('noreply@videorequestline.com','VRL');
     				$message->to($user,'User');
     				$message->cc('noreply@videorequestline.com', 'Super Administrator');
     				$message->subject('Request have been Rejected.');
     			});
			//$passphrase = '12345';
			//$user_detail=DB::table('users')->where('profile_id','=',$requestvideo->requestByProfileId)->first();
     			$user_detail=DB::table('users')->where('profile_id','=',$requestvideo->requestByProfileId)->first();
     			$deviceToken =$user_detail->device_token;
     			$deviceType =$user_detail->device_type;
			/*if($deviceType=='iphone' && $deviceToken!=''){
                $passphrase = '12345';
                
                if($deviceToken!=''){
                    $ctx = stream_context_create();
                    
                    $test = stream_context_set_option($ctx, 'ssl', 'local_cert', 'VRL.pem');
                    
                    stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
                    
                    $fp = stream_socket_client(
                     'ssl://gateway.sandbox.push.apple.com:2195', $err,
                     $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
                    
                    $body['aps'] = array(
                     'alert' => 'Video Request rejected successfully  by '.$artist->Name ,
                     'sound' => 'default',
                     'badge' => 1,
                     );
                    
                    $payload = json_encode($body);
                    
                    $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
                    
                    $result = fwrite($fp, $msg, strlen($msg));
                    fclose($fp);
					return redirect(url()->previous())->with('success','Rejected successfully'); 
                }else{
                    $successmsg="Device token not found";
                    return redirect(url()->previous())->with('success','Rejected successfully');
                    
                }
            }*/
            /*if($deviceType=='android' && $deviceToken!=''){
        
                $to=$deviceToken;
                $title="Video Request";//  
                $message='Video Request rejected successfully  by '.$artist->Name;
                    define( 'API_ACCESS_KEY','AAAAUezx5KE:APA91bHdeF33VnwpVxrzlK0umno6Cb8sgTDlwmyQITcz9-3_PBBY-RXETQias398AHVqkq45-_Xu0BRopNREelz3n9YBEhI3SkKSo8myUfThTkV4dYOkGdcolMBFpdXHGSVdYnnz9SPXplFAsI7CnYcf54-G8i3bjQ');
                    $registrationIds = array($to);
                    $msg = array
                    (
                        'message' => $message,
                        'title' => $title,
                        'vibrate' => 1,
                        'sound' => 1
                        );
                    $fields = array
                    (
                        'registration_ids' => $registrationIds,
                        'data' => $msg
                        );

                    $headers = array
                    (
                        'Authorization: key='.API_ACCESS_KEY,
                        'Content-Type: application/json'
                        );

                    $ch = curl_init();
                    curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
                    curl_setopt( $ch,CURLOPT_POST, true );
                    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
                    $result = curl_exec($ch );
                    curl_close( $ch );
                            
                     return redirect(url()->previous())->with('success','Rejected successfully');
                 }*/

                 return redirect(url()->previous())->with('success','Rejected successfully');
             }
             else{
             	return redirect('Dashboard')->with('error','Oops ! Something is wrong');
             }
         }
     }
     /*-----------------------upload requested Video------------------------------*/
     public function upload_requested_video($id)
     {
     	$requested_video=Requestvideo::find($id);
	//$requested_user=
     	$requested_user = DB::table('requestvideos')
     	->join('profiles', 'requestvideos.requestByProfileId', '=', 'profiles.ProfileId')
     	->select('*')
     	->get();
     	if($requested_video == null){
     		return redirect (url()->previous());
     	}else if($requested_user == null){
     		return redirect('/video_requests')->with('success','user not exist!');
     	}
     	else{
     		$user_id=$requested_video->requestByProfileId;
     		$user=Profile::find($user_id);
     		$profileData =  Profile::where('EmailId',Auth::user()->email)->first();
     		$data['user']=$user;
     		$data['requested_video']=$requested_video;
     		$data['profileData']=$profileData;
	//dd($data);
     		return view("frontend.artistDashboard.upload_requested_video",$data);
     	}
     }
     public function resend_video($user_id,$request_id){
     	$profile_data = DB::table('users')->where('profile_id','=',$user_id)->select('profile_id')->first();
     	if(count($profile_data)>0){

     		if(Auth::check()){
     			if(Auth::user()->type=="Artist"){
     				return redirect('/');
     			}
     			elseif (Auth::user()->type=="Admin") {
     				return redirect('admin_dashboard');
     			}
     			elseif (Auth::user()->type=="User") {
     				$profile_data = DB::table('users')->where('profile_id','=',$user_id)->select('*')->first();
     				if($profile_data->is_account_active=='1'){
     					$requested_user = DB::table('requested_videos')
     					->select('*')->where('requestby','=',$user_id)->where('id','=',$request_id)
     					->join('profiles','profiles.ProfileId','=','requested_videos.requestby')
     					->first();
     					$data['video_name'] =$requested_user->fileName;
     					$data['thumbnail'] =$requested_user->thumbnail;
     					$data['video_title'] =$requested_user->title;
     					$data['video_description'] = $requested_user->description;


     					if(Mail::send('emails.download_email', $data, function ($message) use ($requested_user) {
     						$message->from('noreply@videorequestline.com', 'Download Video');
     						$message->to($requested_user->EmailId,'codingbrains6@gmail.com');
     						$message->subject('Please download Your requested Video');
     					})){
     						return redirect('user_video')->with('success',"Successfully Sent ");
     					}else{
     						return redirect('user_video')->with('error','fails');

     					}
     				}else{
     					return redirect('/login');
     				}
     			}
     		}
     		else{
     			return redirect('/login');
     		}


     	}else{
     		return redirect('/login');
     	}

     }
     public function artist_resend_video($user_id,$request_id){
     	$requested_user = DB::table('requested_videos')
     	->select('*')->where('requestby','=',$user_id)->where('id','=',$request_id)
     	->join('profiles','profiles.ProfileId','=','requested_videos.requestby')
     	->first();

     	$data['video_name'] =$requested_user->fileName;
     	$data['thumbnail'] =$requested_user->thumbnail;
     	$data['video_title'] =$requested_user->title;
     	$data['video_description'] = $requested_user->description;


     	if(Mail::send('emails.download_email', $data, function ($message) use ($requested_user) {
     		$message->from('noreply@videorequestline.com', 'Download Video');
     		$message->to($requested_user->EmailId,'codingbrains6@gmail.com');
     		$message->subject('Please download Your requested Video');
     	})){
     		return redirect('deliver_video')->with('success',"Successfully Sent ");
     	}else{
     		return redirect('deliver_video')->with('error','fails');

     	}

     }
     public function admin_resend_video($user_id,$request_id){
	//dd('test');
     	if(Auth::check()){
     		$requested_user = DB::table('requested_videos')
     		->select('*')->where('requestby','=',$user_id)->where('id','=',$request_id)
     		->join('profiles','profiles.ProfileId','=','requested_videos.requestby')
     		->first();

     		$data['video_name'] =$requested_user->fileName;
     		$data['thumbnail'] =$requested_user->thumbnail;
     		$data['video_title'] =$requested_user->title;
     		$data['video_description'] = $requested_user->description;


     		if(Mail::send('emails.download_email', $data, function ($message) use ($requested_user) {
     			$message->from('noreply@videorequestline.com', 'Download Video');
     			$message->to($requested_user->EmailId,'codingbrains6@gmail.com');
     			$message->subject('Please download Your requested Video');
     		})){
     			return redirect('get_video_requests')->with('success',"Successfully Sent ");
     		}else{
     			return redirect('get_video_requests')->with('error','fails');

     		}
     	}

     }
     public function pay_extend_storage(){
     	echo "test";
     }
     public function upload_requestedVideo(Request $request)
     {
     	$data = $request->all();
     	$validator = Validator::make(
     		array(
     			'video' =>$request->file('video'),
     			),
     		array(
     			'video' => 'required|mimes:mp4,mpeg',
     			)
     		);
     	if($validator->fails())
     	{
     		return redirect('upload_requested_video/'.$request->requested_video_id)
     		->withErrors($validator)
     		->withInput();
     	}
     	else
     	{
     		$requested_video = new RequestedVideo();
     		$file = $request->file('video');
     		$extension = $file->getClientOriginalExtension();
     		$filename = str_replace(' ', '', $file->getClientOriginalName());
     		$filename = str_replace('-', '', $filename);
		//$rand = rand(11111,99999).date('U');
     		$VideoURL = "http://videorequestlive.com/requested_video/";
     		$requested_video->description = $request->requested_video_description;
     		$requested_video->title = $request->requested_video_title;
     		$requested_video->request_id = $request->requested_video_id;
     		$requested_video->requestby	 = $request->requestedby;
     		$requested_video->uploadedby	 =$request->uploadedby;
     		$rand = rand(11111,99999).date('U');
     		$destination = base_path() . '/public/requested_video/';
     		$fileName = $rand.'.'.$extension;
     		$request->file('video')->move($destination,$fileName);
     		$destination_path= $destination.$fileName;
     		$requested_video->url	 =$VideoURL.$fileName;
     		$requested_video->fileName	 =$fileName;
     		$requested_video->is_active	 =1;
     		$requested_video->Upload_date=date('Y-m-d');
     		$requested_video->purchase_date=date('Y-m-d');
     		$purge_data = DB::table('setting')->select('status')->where('name','=',"purge")->first();
     		$requested_video->remain_storage_duration=$purge_data->status;

     		$ffmpeg = FFMpeg\FFMpeg::create(array(
     			'ffmpeg.binaries'  => '/usr/local/bin/ffmpeg',
     			'ffprobe.binaries' => '/usr/local/bin/ffprobe',
     			'timeout'          => 3600,
     			'ffmpeg.threads'   => 12,
     			));		
     		$uploaded_video = $ffmpeg->open($destination.$fileName);
     		$ffprobe = FFMpeg\FFProbe::create(array(
     			'ffmpeg.binaries'  => '/usr/lbin/ffmpeg',
     			'ffprobe.binaries' => '/usr/local/bin/ffprobe',
     			'timeout'          => 3600,
     			'ffmpeg.threads'   => 12,
     			));
     		/*-------------------------retrieving Video Duration----------------------------*/
     		$video_length = $ffprobe->streams($destination.$fileName)
     		->videos()
     		->first()
     		->get('duration');

     		if($video_length < 15){
     			return redirect('upload_requested_video/'.$request->requested_video_id)->with('error','Video duration must be of 15 seconds');
     		}
     		else{
     			/*----------------------------retrieving Thumbnail------------------------------*/
     			$video_thumbnail_path = base_path() . '/public/requested_video/thumbnail/'.date('U').'.jpg';
     			$uploaded_video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(2))->save($video_thumbnail_path);
     			$requested_video->thumbnail	 = $video_thumbnail_path;
     			if($requested_video->save())
     			{
     				$video_requests = Requestvideo::find($request->requested_video_id);
     				if($video_requests==null){
     					return redirect('/video_requests')->with('success','Request has been deleted by User');
     				}else if($video_requests->RequestStatus=='Reject'){
     					return redirect('/video_requests')->with('success','Request has been Rejected by You');
     				}else{
			//if($video_requests!=null and $video_requests->RequestStatus!='Reject'){
     					$video_requests->RequestStatus = "Completed";
     					$video_requests->save();
     					$video_requests = Requestvideo::find($request->requested_video_id);
     					$data['video_name'] =$fileName;
     					$data['thumbnail'] =$video_thumbnail_path;
     					$data['video_title'] =$request->requested_video_title;
     					$data['video_description'] = $request->requested_video_description;
     					Mail::send('emails.download_email', $data, function ($message) use ($request) {
     						$message->from('noreply@videorequestline.com', 'Download Video');
     						$message->to($request->user_email, $request->user_email);
     						$message->subject('Please download Your requested Video');
     					});
     					$artist = Profile::find($request->uploadedby);
     					$user_detail=DB::table('users')->where('profile_id','=',$request->requestedby)->first();
     					$admin_data['user_name'] = $user_detail->user_name;
     					$admin_data['artist_name'] = $artist->Name;
     					$admin_data['video_price'] = $artist->VideoPrice;
     					$admin_data['video_title'] = $request->requested_video_title;
     					$admin_data['video_description'] = $request->requested_video_description;
     					$admin_data['video_completion'] = $video_requests->ComplitionDate;
     					$admin_data['thumbnail'] =$video_thumbnail_path;
     					Mail::send('emails.admin_download_email', $admin_data, function ($message) use ($request) {
     						$message->from('noreply@videorequestline.com', 'Video Upload');
     						$message->to('admin@videorequestline.com', 'admin@videorequestline.com');
     						$message->subject('Artist Uploaded Video To user');
     					});
     					$artist_data['user_name'] = $user_detail->user_name;
     					$artist_data['video_price'] = $artist->VideoPrice;
     					$artist_data['video_title'] = $request->requested_video_title;
     					$artist_data['video_description'] = $request->requested_video_description;
     					$artist_data['video_completion'] = $video_requests->ComplitionDate;
     					$artist_data['thumbnail'] =$video_thumbnail_path;
     					Mail::send('emails.artist_download_email', $artist_data, function ($message) use ($request) {
     						$message->from('noreply@videorequestline.com', 'Download Video');
     						$message->to(Auth::user()->email,Auth::user()->email);
     						$message->subject('Video Uploaded Successfully');
     					});
					//$user_detail=DB::table('users')->where('profile_id','=',$requestvideo->requestByProfileId)->first();
     					$deviceToken =$user_detail->device_token;
     					$deviceType =$user_detail->device_type;
            /*if($deviceType=='iphone' && $deviceToken!=''){
                $passphrase = '12345';
                
                if($deviceToken!=''){
                    $ctx = stream_context_create();
                    
                    $test = stream_context_set_option($ctx, 'ssl', 'local_cert', 'VRL.pem');
                    
                    stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
                    
                    $fp = stream_socket_client(
                     'ssl://gateway.sandbox.push.apple.com:2195', $err,
                     $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
                    
                    $body['aps'] = array(
                     'alert' => 'Upload Request Video successfully  by '.$artist->Name.'Please check your email to download video' ,
                     'sound' => 'default',
                     'badge' => 1,
                     );
                    
                    $payload = json_encode($body);
                    
                    $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
                    
                    $result = fwrite($fp, $msg, strlen($msg));
                    fclose($fp);
                    return redirect('/video_requests')->with('success','Upload successfully'); 
                }else{
                    $successmsg="Device token not found";
                    return redirect('video_requests')->with('error','Device token not found');
                    
                }
            }*/
            /*if($deviceType=='android' && $deviceToken!=''){
        
                $to=$deviceToken;
                $title="Video Request";//  
                $message='Upload Request video successfully  by '.$artist->Name.'Please check your email to download video';
                    define( 'API_ACCESS_KEY','AAAAUezx5KE:APA91bHdeF33VnwpVxrzlK0umno6Cb8sgTDlwmyQITcz9-3_PBBY-RXETQias398AHVqkq45-_Xu0BRopNREelz3n9YBEhI3SkKSo8myUfThTkV4dYOkGdcolMBFpdXHGSVdYnnz9SPXplFAsI7CnYcf54-G8i3bjQ');
                    $registrationIds = array($to);
                    $msg = array
                    (
                        'message' => $message,
                        'title' => $title,
                        'vibrate' => 1,
                        'sound' => 1
                        );
                    $fields = array
                    (
                        'registration_ids' => $registrationIds,
                        'data' => $msg
                        );

                    $headers = array
                    (
                        'Authorization: key='.API_ACCESS_KEY,
                        'Content-Type: application/json'
                        );

                    $ch = curl_init();
                    curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
                    curl_setopt( $ch,CURLOPT_POST, true );
                    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
                    $result = curl_exec($ch );
                    curl_close( $ch );
                            
                     return redirect('/video_requests')->with('success','Successfully Uploaded');
                 }*/
                 return redirect('/video_requests')->with('success','Successfully Uploaded!');
			//}else{
				//return redirect('/video_requests')->with('success','Request has been deleted by User');
             }
         }
     }
 }
}
/*-----------------------Download Video------------------------------*/
public function download_video($video)
{
	$filename =base_path() . '/public/requested_video/'.$video; 
	header('Pragma: public');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Cache-Control: private', false); // required for certain browsers 
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename="'. basename($filename) . '";');
	header('Content-Transfer-Encoding: binary');
	header('Content-Length: ' . filesize($filename));
	readfile($filename);
	exit;
}
/*-----------------------Download Sample Video------------------------------*/
public function download_sample_video($video)
{
	$filename =base_path() . '/public/video/watermark/'.$video; 
	header('Pragma: public');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Cache-Control: private', false); // required for certain browsers 
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename="'. basename($filename) . '";');
	header('Content-Transfer-Encoding: binary');
	header('Content-Length: ' . filesize($filename));
	readfile($filename);
	exit;
}
/*-----------------------view Video on artist dashboard-------------------------*/
public function view_video($video)
{
	if(Auth::check()){
		if(Auth::user()->type=="Artist"){
			$deliver_videos = DB::table('requested_videos')->select('*')
			->where('requested_videos.uploadedby','=',Auth::user()->profile_id)
			->where('requested_videos.id','=',$video)
			->paginate(15);
			$artist = Profile::find(Auth::user()->profile_id);
			$video_data['video'] = $deliver_videos;
			$video_data['artist'] = $artist;
          //dd($video_data);
          //return view('frontend.my_video',$video_data);
			return view('frontend.artistDashboard.view_video',$video_data); 
		}else{
			return redirect('/login');
		}
	}else{
		return redirect('/login'); 
	} 
	//return view("frontend.artistDashboard.view_video");

}
/*------------------------------Edit video on artist----------------------*/
public function edit_video($video){
	if(Auth::check()){
		if(Auth::user()->type=="Artist"){
			$deliver_videos = DB::table('requested_videos')->select('*')
			->where('requested_videos.uploadedby','=',Auth::user()->profile_id)
			->where('requested_videos.id','=',$video)
			->paginate(15);
			$artist = Profile::find(Auth::user()->profile_id);
			$video_data['video'] = $deliver_videos;
			$video_data['artist'] = $artist;
          //return view('frontend.my_video',$video_data);
			return view('frontend.artistDashboard.edit_video',$video_data); 
		}else{
			return redirect('/login');
		}
	}else{
		return redirect('/login'); 
	} 

}

/*public function test_video(){
	$rand = rand(11111,99999).date('U');
	$ffmpegPath = '/usr/local/bin/ffmpeg';
	$inputPath = 'https://www.videorequestlive.com/uploads/7572356195768348.webm';
	$watermark = '/home/vrl/public_html/public/vrl_logo.png';
	$outPath = 'http://videorequestlive.com/requested_video/'.$rand.'.mp4';
	shell_exec("$ffmpegPath  -i $inputPath -i $watermark -filter_complex overlay=main_w-overlay_w-20:main_h-overlay_h-20 $outPath ");
	echo $rand;
}*/
public function post_edit_video(Request $request){
	//dd($request->all());
	$validator = Validator::make(
		array(
			'video_title' =>$request->video_title,
			'video_description' => $request->video_description,
			//'video' =>$request->file('video'),
			),
		array(
			'video_title' =>'required',
			'video_description' =>'required',
			//'video' => 'required|mimes:mp4,mpeg',
			)
		);
	if($validator->fails())
	{
		return redirect('/edit_video/'.$request->requested_video_id)
		->withErrors($validator)
		->withInput();
	}
	else
	{
		//dd($_FILES['video']["name"]);
		if($_FILES['video']["name"]!=""){
			$file = $request->file('video');
			$extension = $file->getClientOriginalExtension();
			$filename = str_replace(' ', '', $file->getClientOriginalName());
			$filename = str_replace('-', '', $filename);
			$VideoURL = "http://videorequestlive.com/video/".date('U') .$filename ;
			$ffmpeg = FFMpeg\FFMpeg::create(array(
				'ffmpeg.binaries'  => '/usr/local/bin/ffmpeg',
				'ffprobe.binaries' => '/usr/local/bin/ffprobe',
				'timeout'          => 3600,
				'ffmpeg.threads'   => 12,
				));
			$rand = rand(11111,99999).date('U');
			$destination = base_path() . '/public/requested_video/';
			$fileName = $rand.'.'.$extension;
			$request->file('video')->move($destination,$fileName);
			$destination_path= $destination.$fileName;
			$orginal_video = new OriginalVideo();
			$orginal_video->video_path=$destination_path;
			$orginal_video->save();
			$orginal_video_id= $orginal_video->id;
			$orginal_video = OriginalVideo::find($orginal_video_id);
			$uploaded_video = $ffmpeg->open($orginal_video->video_path);

			/*----------------------------retrieving Thumbnail------------------------------*/
			$video_thumbnail_path = base_path() . '/public/requested_video/thumbnail/'.date('U').'.jpg';
			$uploaded_video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(2))->save($video_thumbnail_path);
			/*----------------------------Applying Watermark----------------------------------*/
			$ffmpegPath = '/usr/local/bin/ffmpeg';
			$inputPath = $orginal_video->video_path;
			$watermark = '/home/vrl/public_html/public/vrl_logo.png';
			$outPath = 'http://videorequestlive.com/requested_video/'.$rand.'.mp4';
			shell_exec("$ffmpegPath  -i $inputPath -i $watermark -filter_complex overlay=main_w-overlay_w-20:main_h-overlay_h-20 $outPath ");
			/*	----------------------------------Saving Video-------------------------------*/
			$watermark_video_destination = substr($outPath,28);
			//$video->VideoURL	 = $outPath;
			//$video->originalVideoUrl	 = $orginal_video->video_path;
			$ffprobe = FFMpeg\FFProbe::create(array(
				'ffmpeg.binaries'  => '/usr/lbin/ffmpeg',
				'ffprobe.binaries' => '/usr/local/bin/ffprobe',
				'timeout'          => 3600,
				'ffmpeg.threads'   => 12,
				));
			if(DB::table('requested_videos')->
				where('id', $request->requested_video_id)->
				update(array('title' => $request->video_title ,'description' => $request->video_description,'thumbnail'=>$video_thumbnail_path,'url'=>$outPath,'fileName'=>$fileName))){
				return redirect('/edit_video/'.$request->requested_video_id)->with('success','Successfully Updated!');
		}
	}else{
		if(DB::table('requested_videos')->
			where('id', $request->requested_video_id)->
			update(array('title' => $request->video_title ,'description' => $request->video_description))){
			return redirect('/edit_video/'.$request->requested_video_id)->with('success','Successfully Updated!');
	}
}



}
}
/*-----------------------Artist Record Video------------------------------*/
public function record_video() {
	if(Auth::check()){
		if(Auth::user()->type=="Admin"){
			return redirect('admin_dashboard');
		}
		elseif (Auth::user()->type=="User") {
			return redirect('profile');
		}
		else{
			$profileData =  Profile::where('EmailId',Auth::user()->email)->first();
			$artistData['profileData'] = $profileData;
			$artistData['baseurl'] = "http://videorequestlive.com/";
			return view("frontend.artistDashboard.record_video",$artistData);
		}
	}
	else{
		return view('frontend.login');
	}
}
public function record_own_video(Request $request){
	$data = $request->all();
	//dd($data);
	$validator = Validator::make(
		array(
			'video_title' =>$request->video_title,
			'video_description' => $request->video_description,
			'video' =>$request->file('video'),
			),
		array(
			'video_title' =>'required|unique:video,Title',
			'video_description' =>'required|min:80',
			'video' => 'required|mimes:mp4,mpeg',
			)
		);
	if($validator->fails())
	{
		return redirect('record_video')
		->withErrors($validator)
		->withInput();
	}
	else
	{
		$video = new Video();
		$file = $request->file('video');
		$extension = $file->getClientOriginalExtension();
		$filename = str_replace(' ', '', $file->getClientOriginalName());
		$filename = str_replace('-', '', $filename);
		$VideoURL = "http://videorequestlive.com/video/".date('U') .$filename ;
		$video->VideoFormat = $file->getClientOriginalExtension();
		$video->VideoSize = ($file->getSize()/1024) . "mb";
		//$video->VideoPrice = $request->video_price;
		$video->Description = $request->video_description;
		$video->Title = $request->video_title;
		$video->VideoUploadDate = Carbon::now()->format('m-d-Y');
		$video->ProfileId	 = Auth::user()->profile_id;
		$video->UploadedBy	 = "Artist";
		$video->download_status	 = $request->download_status;
		$video->home_auto_play_status = $request->autoPlay_status;
		$video->profile_auto_play_status = $request->profile_autoPlay_status;
		$video->video_auto_play_status = $request->video_autoPlay_status;

		$ffmpeg = FFMpeg\FFMpeg::create(array(
			'ffmpeg.binaries'  => '/usr/local/bin/ffmpeg',
			'ffprobe.binaries' => '/usr/local/bin/ffprobe',
			'timeout'          => 3600,
			'ffmpeg.threads'   => 12,
			));
		/*--------------------------Opening Uploaded Video------------------------------*/
		$rand = rand(11111,99999).date('U');
		$destination = base_path() . '/public/video/original/';
		$fileName = $rand.'.'.$extension;
		$request->file('video')->move($destination,$fileName);
		$destination_path= $destination.$fileName;
		$orginal_video = new OriginalVideo();
		$orginal_video->video_path=$destination_path;
		$orginal_video->save();
		$orginal_video_id= $orginal_video->id;
		$orginal_video = OriginalVideo::find($orginal_video_id);
		$uploaded_video = $ffmpeg->open($orginal_video->video_path);
		$ffprobe = FFMpeg\FFProbe::create(array(
			'ffmpeg.binaries'  => '/usr/local/ffmpeg',
			'ffprobe.binaries' => '/usr/local/bin/ffprobe',
			'timeout'          => 3600,
			'ffmpeg.threads'   => 12,
			));
		/*-------------------------retrieving Video Duration----------------------------*/
		$video_length = $ffprobe->streams($destination.$fileName)
		->videos()
		->first()
		->get('duration');

		if($video_length < 15){
			return redirect('record_video')->with('error','Video duration must be of 15 seconds');
		}
		else{
			/*----------------------------retrieving Thumbnail------------------------------*/
			$video_thumbnail_path = base_path() . '/public/images/thumbnails/'.date('U').'.jpg';
			$uploaded_video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(2))->save($video_thumbnail_path);
			$video->VideoThumbnail	 = $video_thumbnail_path;
			/*----------------------------Applying Watermark----------------------------------*/
			$ffmpegPath = '/usr/local/bin/ffmpeg';
			$inputPath = $orginal_video->video_path;
			$watermark = '/home/vrl/public_html/public/vrl_logo.png';
			$outPath = '/home/vrl/public_html/public/video/watermark/'.date('U').'.mp4';
			shell_exec("$ffmpegPath  -i $inputPath -i $watermark -filter_complex overlay=main_w-overlay_w-20:main_h-overlay_h-20 $outPath ");
			
			/*	----------------------------------Saving Video-------------------------------*/
			$watermark_video_destination = substr($outPath,28);
			$video->VideoURL	 = $outPath;
			$video->originalVideoUrl	 = $orginal_video->video_path;
			$ffprobe = FFMpeg\FFProbe::create(array(
				'ffmpeg.binaries'  => '/usr/local/bin/ffmpeg',
				'ffprobe.binaries' => '/usr/local/bin/ffprobe',
				'timeout'          => 3600,
				'ffmpeg.threads'   => 12,
				));
			/*-------------------------retrieving Video Duration----------------------------*/
			$video->VideoLength = $ffprobe->streams($orginal_video->video_path)
			->videos()
			->first()
			->get('duration');
	// $destinationPath = base_path() . '/public/video/';
	// $request->file('video')->move($destinationPath, "video/".date('U') .$filename);
			if($video->save())
			{
				return redirect('record_video')->with('success','Successfully Uploaded!');
			}
		}
	}
}
/*-----------------------------------Sold video List-------------------------------------*/
public function sold_videos() {
	if(Auth::check()){
		if(Auth::user()->type=="Admin"){
			return redirect('admin_dashboard');
		}
		elseif (Auth::user()->type=="User") {
			return redirect('profile');
		}
		else{
			$user =  User::where('email',Auth::user()->email)->first();
			$sold_videos = DB::table('video')->select('video.*','payments.*')
			->join('payments','payments.video_id','=','video.VideoId')->get();
			$sold_videos = DB::table('video')->select('video.*','payments.*')->where('ProfileId', '=',$user->profile_id)
			->join('payments',function($join){
				$join->on('video.VideoId', '=', 'payments.video_id');
			})->get();
			$image_path = DB::table('profiles')->where('EmailId', $user->email)->first();
			$artist_data['users'] = $user;
			$artist_data['sold_videos'] = $sold_videos;
			$artist_data['image_paths'] = $image_path;
			return view('frontend.artistDashboard.sold_video',$artist_data);
		}
	}
	else{
		return redirect('/');
	}
}
/*--------------------------------Artist Log Out--------------------------------*/
public function getLogout() {
	if(Auth::check()){
		if(Auth::user()->type=="Admin"){
			Session::flush();
			Auth::logout();
			return redirect('/admin')->with('success','Successfully Signout');
		}
		else{
			Session::flush();
			Auth::logout();
			return redirect('/login');
		}
	}
	else{
		Session::flush();
		Auth::logout();
		return redirect('/login');
	}
}
public function videoDetails(Request $request){
	$data = DB::table('video')->where('VideoId',$request->id)->get();
	return view('frontend.VideoDetails')->with('detail',$data);
}
//
public function artist_search(Request $request)
{
	$search_query =  $request->search_query ;
	$search_result = Profile::where('Name', 'LIKE', '%'.$search_query.'%')
	->where('Type', '=', 'Artist')->get();
	
	$pageData['search_result'] = $search_result;
	return view('frontend.artist_search',$pageData);
}
public function search_video(Request $request)
{
	$search_query =  $request->search_query ;
	$search_video = Video::where('Title', 'LIKE','%'.$search_query.'%')->get();
	
	$pageData['search_video'] = $search_video;
	return view('frontend.search_video',$pageData);
}
//search_req_video rajesh
/*public function search_req_video(Request $request)
{
	$search_query =  $request->search_query;
	$search_video = Video::where('Title', 'LIKE','%'.$search_query.'%')->get();
	
	$pageData['search_video'] = $search_video;
	return view('frontend.search_req_video',$pageData);
}*/
public function search_result(Request $request)
{
	$search_query =  $request->search_query ;
	//$search_result = Profile::where('Name', 'LIKE', '%'.$search_query.'%')
	//->where('Type', '=', 'Artist')->get();
	$search_result =DB::table('users')
	->select('users.*','profiles.*')
	->where('Name', 'LIKE', '%'.$search_query.'%')
	->where('users.is_account_active', '=','1')
	->join('profiles','profiles.ProfileId','=','users.profile_id')->paginate(15);
	/*$search_result =DB::table('users')->select('users.*','profiles.*')
	->where('users.is_account_active', '=','1')
	->where('Name', 'LIKE', '%'.$search_query.'%')
	->where('Type', '=', 'Artist')
	->join('profiles','profiles.ProfileId','=','users.profile_id')->get();
*/
	/*$search_video = DB::table('video')->select('video.*','profiles.*')
	->where('Title', 'LIKE','%'.$search_query.'%')
	->join('profiles',function($join){
		$join->on('video.ProfileId', '=', 'profiles.ProfileId');
	})->get();*/
	
	$search_video =DB::table('users')
	->select('users.*','video.*')
	->where('Title', 'LIKE','%'.$search_query.'%')
	->where('users.is_account_active', '=','1')
	->join('video','video.ProfileId','=','users.profile_id')
	->orderByRaw("RAND()")
	->orderBy('ProfileId','desc')
	->take(7)
	->get();
///////////////
	$random_artist =DB::table('users')
	->select('users.*','profiles.*')

	->where('users.is_account_active', '=','1')
	->join('profiles','profiles.ProfileId','=','users.profile_id')
	->orderByRaw("RAND()")
	->orderBy('ProfileId','desc')
	->take(7)
	->get();
////////////////
	/*$random_artist = Profile::where('Type', '=', 'Artist')
	->orderByRaw("RAND()")
	->orderBy('ProfileId','desc')
	->take(7)
	->get();*/
	$random_video = DB::table('video')
	->select('video.*','profiles.*')
	->orderByRaw("RAND()")
	->orderBy('VideoId','desc')
	->join('profiles',function($join){
		$join->on('video.ProfileId', '=', 'profiles.ProfileId');
	})->take(7)->get();
	$pageData['search_result'] = $search_result;
	$pageData['search_video'] = $search_video;
	$pageData['random_video'] = $random_video;
	$pageData['random_artist'] = $random_artist;
	return view('frontend.search',$pageData);
}
public function get_social_link()
{
	if(Auth::check()){
		if(Auth::user()->type=="Admin"){
			return redirect('admin_dashboard');
		}elseif (Auth::user()->type=="User") {
			return redirect('profile');
		}else{
			$profileData =  Profile::where('EmailId',Auth::user()->email)->first();
			$social_data = DB::table('social media')->where('addBy_profileId', Auth::user()->profile_id)->orderBy('id','desc')->get();
			$artistData['profileData'] = $profileData;
			$artistData['social_data'] = $social_data;
			$artistData['baseurl'] = "http://videorequestlive.com/";
			return view('frontend.artistDashboard.get_social_link',$artistData);
		}
	}else{
		return redirect('/login');
	}
}
public function add_social_link(Request $request)
{
	$data = $request->all();
	//dd($data);
	$validator = Validator::make($data,
		array(
			'facebook_link' =>'required',
			'twitter_link' =>'required',
			'instagram_link' =>'required',
			)
		);
	if($validator->fails()){
		return redirect('get_social_link')
		->withErrors($validator)
		->withInput();
	}else{
		$artist = Profile::find($request->ProfileId);
		$artist->facebook_link = $request->facebook_link;
		$artist->instagram_link = $request->instagram_link;
		$artist->twitter_link = $request->twitter_link;
		$artist->more_link = $request->twitter_link;

		if($artist->save()) {
			return redirect('get_social_link')->with('success', 'Successfully Updated!');
		}
	}
}
public function get_edit_url()
{
	if(Auth::check()){
		if(Auth::user()->type=="Admin"){
			return redirect('admin_dashboard');
		}
		elseif (Auth::user()->type=="User") {
			return redirect('profile');
		}
		else{
			$profileData =  Profile::where('EmailId',Auth::user()->email)->first();
			$artistData['profileData'] = $profileData;
			$artistData['baseurl'] = "http://videorequestlive.com/";
			return view('frontend.artistDashboard.edit_url',$artistData);
		}
	}else{
		return redirect('/login');
	}
}
public function update_url(Request $request)
{
	if(!Auth::check()){
		return redirect('/');

	}else{
		$data = $request->all();
		$validator = Validator::make($data,
			array(
				'profile_url' =>'required|alpha_num|unique:profiles,profile_url',
				)
			);
		if($validator->fails()){
			return redirect('edit_url')
			->withErrors($validator)
			->withInput();
		}else{
			$artist = Profile::find($request->ProfileId);
			$artist->profile_url = $request->profile_url;
			if($artist->save()) {
				return redirect('edit_url')->with('success', 'Successfully Updated!');
			}
		}
	}
}
/*--------------------------------Request New Video---------------------------------*/
public function requestvideo(Request $request){
	$data = $request->all();
	$messages = [
		//'user_phone.regex' => 'Use valid Phone No (as 111-111-1111)',
	'user_name.regex' => 'Use valid User name (as xyz or xyz1)',
	'sender_name.regex' => 'Use valid User name (as xyz or xyz1)',
	'user_name.required' => 'The receipient name field is required',
	];

	$validator = Validator::make($data,
		array(
			'artist'=>'required',
			'user_name'=>'required',
			'user_email'=>'required|email',
			'sender_name' =>'required',
			'sender_email'=>'required|email',
			'delivery_date'=>'required',
			),$messages
		);
	if($validator->fails()){
		$previous_url = url()->previous();
		$findme   = 'http://videorequestlive.com/RequestNewVideo/';
		$pos = strpos($previous_url, $findme);
		if($pos !== false){
			return redirect('RequestNewVideo/'.$request->artist)
			->withErrors($validator)
			->withInput();
		}
		else{
			return redirect('/')
			->withErrors($validator)
			->withInput();
		}
	}else{
		$artist_data = \App\Profile::find($request->artist);
		if(is_null($artist_data)){
			return redirect('/')->with('error','Artist not found');
		}
		else{
			$Status="Pending";
			$type='User';
			$password=str_random(8);
			$hashed_random_password = Hash::make(str_random(8));
			$user_favorites = DB::table('users')
			->where('email', '=', $request->user_email)
			->first();
			if (! is_null($user_favorites)) { 
				if($user_favorites->type=='Artist'){
					return redirect(url()->previous())->with('error','Artist can not send request by this email');
				}
				else{
					$artist_id =  User::where('profile_id',$request->artist)->first();
					if($artist_id->is_account_active==1)
					{
						$Requestvideo= new Requestvideo();
						$Requestvideo->requestToProfileId=$request->artist;
						$Requestvideo->song_name=$request->song_name;
						$Requestvideo->Name=$request->user_name;
						$Requestvideo->receipient_pronunciation=$request->pronun_name;
						$Requestvideo->requestor_email=$request->user_email;
						$Requestvideo->sender_name=$request->sender_name;
						$Requestvideo->sender_name_pronunciation=$request->sender_name_pronun;
						$Requestvideo->sender_email=$request->sender_email;
						$Requestvideo->complitionDate=$request->delivery_date;
						$Requestvideo->Title=$request->Occassion;
						$Requestvideo->Description=$request->person_message;
						$Requestvideo->RequestStatus=$Status;
						$Requestvideo->is_active=1;
						$Requestvideo->request_date=Carbon::now()->format('m-d-Y');
						$artist_data= Profile::find($request->artist);
						$users = DB::table('profiles')->where('EmailId',$request->user_email)->first();
						$profId= $users->ProfileId;
						$Requestvideo->ReqVideoPrice=$artist_data->VideoPrice;
						$mydate = date('m-d-Y');
						$Requestvideo->save();
						$profname= $request->user_name;
						DB::table('requestvideos')
						->where('Name',$profname)
						->update(array('requestByProfileId' => $profId ));
						if($Requestvideo->save()){
							$confirmation_code['user_email'] =$request->user_email;
							$confirmation_code['video_title'] =$request->Occassion;
							$confirmation_code['video_description'] = $request->person_message;
							$confirmation_code['current_status'] = $Status;
							$confirmation_code['video_delivery_time'] = $artist_data->timestamp;
							$artist =  Profile::where('ProfileId',$request->artist)->first();
							$confirmation_code['artist_name']=$artist->Name;
							$confirmation_code['artist_email']=$artist->EmailId;
							$confirmation_code['username']=$request->user_name;
							$confirmation_code['password']=$password;
							Mail::send('emails.exist_User_RequestNewVideo', $confirmation_code, function ($message) use ($request) {
								$message->from('noreply@videorequestline.com', 'Confirmation for Video Request');
								$message->to($request->user_email, $request->user_email);
								$message->subject('Successfully requested video');
							});
							Mail::send('emails.admin_RequestNewVideo', $confirmation_code, function ($message) use ($request) {
								$artist =  Profile::where('ProfileId',$request->artist)->first();
								$message->from('noreply@videorequestline.com', 'Confirmation for Video Request');
								$message->to($artist->EmailId, $request->user_email);
								$message->subject('Requested New video');

							});

					//$successmsg="Your Request have been Submitted Successfully.Please check you Email to see details";
					//return redirect('/success_request')->with('success',$successmsg);
							$user_detail=DB::table('users')->where('profile_id','=',$request->artist)->first();
							$deviceToken =$user_detail->device_token;
							$deviceType =$user_detail->device_type;
                        /*if($deviceType=='iphone' && $deviceToken!=''){
                            $passphrase = '12345';
                            
                            if($deviceToken!=''){
                                $ctx = stream_context_create();
                                
                                $test = stream_context_set_option($ctx, 'ssl', 'local_cert', 'VRL.pem');
                                
                                stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
                                
                                $fp = stream_socket_client(
                                 'ssl://gateway.sandbox.push.apple.com:2195', $err,
                                 $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
                                
                                $body['aps'] = array(
                                 'alert' => 'You have receive a video request by '.$request->sender_name ,
                                 'sound' => 'default',
                                 'badge' => 1,
                                 );
                                
                                $payload = json_encode($body);
                                
                                $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
                                
                                $result = fwrite($fp, $msg, strlen($msg));
                                fclose($fp);

                                $successmsg="Your Request have been Submitted Successfully.Please check you Email to see details..";
                                return redirect('/success_request')->with('success',$successmsg); 
                            }else{
                                $successmsg="Device token not found";
                                return redirect('/success_request')->with('error',$successmsg);
                                
                        }
                    }*/
                    /*if($deviceType=='android' && $deviceToken!=''){
                
                        $to=$deviceToken;
                        $title="Video Request";//  
                        $message='You have receive a video request by '.$request->sender_name;
                            define( 'API_ACCESS_KEY','AAAAUezx5KE:APA91bHdeF33VnwpVxrzlK0umno6Cb8sgTDlwmyQITcz9-3_PBBY-RXETQias398AHVqkq45-_Xu0BRopNREelz3n9YBEhI3SkKSo8myUfThTkV4dYOkGdcolMBFpdXHGSVdYnnz9SPXplFAsI7CnYcf54-G8i3bjQ');
                            $registrationIds = array($to);
                            $msg = array
                            (
                                'message' => $message,
                                'title' => $title,
                                'vibrate' => 1,
                                'sound' => 1
                                );
                            $fields = array
                            (
                                'registration_ids' => $registrationIds,
                                'data' => $msg
                                );

                            $headers = array
                            (
                                'Authorization: key='.API_ACCESS_KEY,
                                'Content-Type: application/json'
                                );

                            $ch = curl_init();
                            curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
                            curl_setopt( $ch,CURLOPT_POST, true );
                            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                            curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                            curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
                            $result = curl_exec($ch );
                            curl_close( $ch );
                            
                        $successmsg="Your Request have been Submitted Successfully.Please check you Email to see details..";
                        return redirect('/success_request')->with('success',$successmsg);
                    }*/
                    $successmsg="Your Request have been Submitted Successfully.Please check you Email to see details..";
                    return redirect('/success_request')->with('success',$successmsg);
                }
            }
            else{
            	return redirect('/RequestNewVideo/'.$request->artist)->with('error','You can not sent any request to Artist because Artist is Deactivated');
            }  
        }
    }else{
    	$artist_id =  User::where('profile_id',$request->artist)->first();
    	if($artist_id->is_account_active==1)
    	{
    		$Requestvideo= new Requestvideo();
    		$Requestvideo->requestToProfileId=$request->artist;
    		$Requestvideo->song_name=$request->song_name;
    		$Requestvideo->Name=$request->user_name;
    		$Requestvideo->receipient_pronunciation=$request->pronun_name;
    		$Requestvideo->requestor_email=$request->user_email;
    		$Requestvideo->sender_name=$request->sender_name;
    		$Requestvideo->sender_name_pronunciation=$request->sender_name_pronun;
    		$Requestvideo->sender_email=$request->sender_email;
    		$Requestvideo->Title=$request->Occassion;
    		$Requestvideo->Description=$request->person_message;
    		$Requestvideo->RequestStatus=$Status;
    		$Requestvideo->is_active=1;
    		$Requestvideo->request_date=Carbon::now()->format('m-d-Y');
    		$Profile = new Profile();
    		$users = new User();
    		$users->user_name= $request->user_name;
    		$users->email= $request->user_email;
    		$users->password= Hash::make($password);
    		$users->remember_token = $request->_token;
    		$users->type = $type;
    		$users->is_account_active='1';
    		$users->is_email_active='1';
    		$Profile->EmailId= $request->user_email;
    		$Profile->Type = $type;
    		$Profile->Name=$request->user_name;
			//$Profile->State=$request->user_state;
			//$Profile->country=$request->user_country;
    		$Profile->save();
    		$users->save();
    		$users = DB::table('profiles')->where('EmailId',$request->user_email)->first();
    		$profId= $users->ProfileId;
    		$artist_data= Profile::find($request->artist);
    		$Requestvideo->complitionDate=$request->delivery_date;
    		$Requestvideo->ReqVideoPrice=$artist_data->VideoPrice;
    		$Requestvideo->save();
    		$profname= $request->user_name;;
    		DB::table('users')
    		->where('email', $request->user_email)
    		->update(['profile_id' => $profId]);
    		DB::table('requestvideos')
    		->where('Name',$profname)
    		->update(array('requestByProfileId' => $profId ));
    		if($Requestvideo->save()){
    			$confirmation_code['user_email'] =$request->user_email;
    			$confirmation_code['video_title'] =$request->Occassion;
    			$confirmation_code['video_description'] = $request->person_message;
    			$confirmation_code['current_status'] = $Status;
    			$confirmation_code['video_delivery_time'] = $artist_data->timestamp;
    			$artist =  Profile::where('ProfileId',$request->artist)->first();
    			$confirmation_code['artist_name']=$artist->Name;
    			$confirmation_code['artist_email']=$artist->EmailId;
    			$confirmation_code['username']=$request->user_name;
    			$confirmation_code['password']=$password;
    			Mail::send('emails.User_RequestNewVideo', $confirmation_code, function ($message) use ($request) {
    				$message->from('noreply@videorequestline.com', 'Confirmation for Video Request');
    				$message->to($request->user_email, $request->user_email);
    				$message->subject('Successfully requested video');
    			});
    			Mail::send('emails.admin_RequestNewVideo', $confirmation_code, function ($message) use ($request) {
    				$artist =  Profile::where('ProfileId',$request->artist)->first();

						//$confirmation_code['artist_email']=$artist->EmailId;
    				$message->from('noreply@videorequestline.com', 'Confirmation for Video Request');
    				$message->to($artist->EmailId, $request->user_email);
    				$message->subject('Requested New video');

    			});

				//$successmsg="Your Request have been Submitted Successfully.Please check you Email to see details";
				//return redirect('/success_request')->with('success',$successmsg);
    			$user_detail=DB::table('users')->where('profile_id','=',$request->artist)->first();
    			$deviceToken =$user_detail->device_token;
    			$deviceType =$user_detail->device_type;
                     /*   if($deviceType=='iphone' && $deviceToken!=''){
                            $passphrase = '12345';
                            
                            if($deviceToken!='' and $deviceType=='iphone'){
                                $ctx = stream_context_create();
                                
                                $test = stream_context_set_option($ctx, 'ssl', 'local_cert', 'VRL.pem');
                                
                                stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
                                
                                $fp = stream_socket_client(
                                 'ssl://gateway.sandbox.push.apple.com:2195', $err,
                                 $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
                                
                                $body['aps'] = array(
                                 'alert' => 'You have receive a video request by '.$request->sender_name ,
                                 'sound' => 'default',
                                 'badge' => 1,
                                 );
                                
                                $payload = json_encode($body);
                                
                                $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
                                
                                $result = fwrite($fp, $msg, strlen($msg));
                                fclose($fp);

                                $successmsg="Your Request have been Submitted Successfully.Please check you Email to see details..";
                                return redirect('/success_request')->with('success',$successmsg); 
                            }else{
                                $successmsg="Device token not found";
                                return redirect('/success_request')->with('error',$successmsg);
                                
                        }
                    }*/
                    /*if($deviceType=='android' && $deviceToken!=''){
                
                        $to=$deviceToken;
                        $title="Video Request";//  
                        $message='You have receive a video request by '.$request->sender_name;
                            define( 'API_ACCESS_KEY','AAAAUezx5KE:APA91bHdeF33VnwpVxrzlK0umno6Cb8sgTDlwmyQITcz9-3_PBBY-RXETQias398AHVqkq45-_Xu0BRopNREelz3n9YBEhI3SkKSo8myUfThTkV4dYOkGdcolMBFpdXHGSVdYnnz9SPXplFAsI7CnYcf54-G8i3bjQ');
                            $registrationIds = array($to);
                            $msg = array
                            (
                                'message' => $message,
                                'title' => $title,
                                'vibrate' => 1,
                                'sound' => 1
                                );
                            $fields = array
                            (
                                'registration_ids' => $registrationIds,
                                'data' => $msg
                                );

                            $headers = array
                            (
                                'Authorization: key='.API_ACCESS_KEY,
                                'Content-Type: application/json'
                                );

                            $ch = curl_init();
                            curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
                            curl_setopt( $ch,CURLOPT_POST, true );
                            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                            curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                            curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
                            $result = curl_exec($ch );
                            curl_close( $ch );
                            
                        $successmsg="Your Request have been Submitted Successfully.Please check you Email to see details..";
                        return redirect('/success_request')->with('success',$successmsg);
                    }*/
                    $successmsg="Your Request have been Submitted Successfully.Please check you Email to see details..";
                    return redirect('/success_request')->with('success',$successmsg);
                }
            }
            else{
            	return redirect('/RequestNewVideo/'.$request->artist)->with('error','You can not sent any request to Artist because Artist is Deactivated');
            } 


        }
    }
}

}
public function check_user_auth()
{
	$email = Session::get('email');
	$password = Session::get('password');
	$user = array('email'=>$email);
	$result = \DB::table('users')->where($user)->first();
	if(!is_null($result)){
		if((Hash::check($password, $result->password)) && ($result->is_account_active == 1) ){
			echo "present";
		}
		else{
			echo "false";
		}
	}
}

public function move_file(){
	$source = "source/";
	$destination = "destination/";
	$file="UserVideo.blade.php";
	if (copy($source.$file, $destination.$file)) {
		$delete[] = $source.$file;
	}
	foreach ($delete as $file) {
		unlink($file);
	}
	
}

}
