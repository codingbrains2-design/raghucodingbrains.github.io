import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import { FormBuilder, Validators } from '@angular/forms';


@Component({
	selector: 'page-parent-login',
	templateUrl: 'parent-login.html'
})
export class ParentLoginPage {
	parentLoginForm:any
	constructor(public navCtrl: NavController,public fb: FormBuilder) {
		this.parentLoginForm =  fb.group({
			email:['',Validators.required],
			password:['',Validators.required],

		})
	}
	logForm() {
		console.log(this.parentLoginForm.value)
	}

}
