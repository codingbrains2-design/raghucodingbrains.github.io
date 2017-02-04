import { NgModule, ErrorHandler } from '@angular/core';
import { IonicApp, IonicModule, IonicErrorHandler } from 'ionic-angular';
import { MyApp } from './app.component';
import { MainPage } from '../pages/main/main';
import { ParentLoginPage } from '../pages/parent-login/parent-login';
import { TutorLoginPage } from '../pages/tutor-login/tutor-login';


@NgModule({
  declarations: [
  MyApp,
  MainPage,
  ParentLoginPage,
  TutorLoginPage
  ],
  imports: [
  IonicModule.forRoot(MyApp)
  ],
  bootstrap: [IonicApp],
  entryComponents: [
  MyApp,
  MainPage,
  ParentLoginPage,
  TutorLoginPage
  ],
  providers: [{provide: ErrorHandler, useClass: IonicErrorHandler}]
})
export class AppModule {}
