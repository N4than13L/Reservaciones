import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

// formulario
import { FormsModule } from '@angular/forms';
import { HttpClientModule, HttpHeaders } from '@angular/common/http';

// archivos
import { AngularFileUploaderModule } from 'angular-file-uploader';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { LoginComponent } from './components/login/login.component';
import { RegisterComponent } from './components/register/register.component';
import { HomeComponent } from './components/home/home.component';
import { ErrorComponent } from './components/error/error.component';
import { UserEditComponent } from './components/user-edit/user-edit.component';
import { BookingtypeComponent } from './components/bookingtype/bookingtype.component';
import { BookingComponent } from './components/booking/booking.component';
import { BookingEditComponent } from './components/booking-edit/booking-edit.component';

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    RegisterComponent,
    HomeComponent,
    ErrorComponent,
    UserEditComponent,
    BookingtypeComponent,
    BookingComponent,
    BookingEditComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    HttpClientModule,
    AngularFileUploaderModule,
  ],
  providers: [],
  bootstrap: [AppComponent],
})
export class AppModule {}
