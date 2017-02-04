import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import { ParentLoginPage } from '../parent-login/parent-login';
import { TutorLoginPage } from '../tutor-login/tutor-login';

@Component({
	selector: 'page-main',
	templateUrl: 'main.html'
})
export class MainPage {

	constructor(public navCtrl: NavController,) {}
	tutor_login(){
		this.navCtrl.push(TutorLoginPage);
	}
	parent_login(){
		this.navCtrl.push(ParentLoginPage);
	}

}
