import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import { FormBuilder, Validators } from '@angular/forms';


/*
  Generated class for the TutorLogin page.

  See http://ionicframework.com/docs/v2/components/#navigation for more info on
  Ionic pages and navigation.
  */
  @Component({
  	selector: 'page-tutor-login',
  	templateUrl: 'tutor-login.html'
  })
  export class TutorLoginPage {
  	tutorLoginForm:any
  	constructor(public navCtrl: NavController,public fb: FormBuilder) {
  		this.tutorLoginForm =  fb.group({
  			email:['',Validators.required],
  			password:['',Validators.required],

  		})
  	}
  	logForm() {
  		console.log(this.tutorLoginForm.value)
  	}
  }