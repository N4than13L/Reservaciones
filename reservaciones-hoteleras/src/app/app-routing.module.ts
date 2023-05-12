// dependencias necesarias.
import { NgModule, ModuleWithProviders } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

// importacion de componentes.
import { LoginComponent } from './components/login/login.component';
import { RegisterComponent } from './components/register/register.component';
import { HomeComponent } from './components/home/home.component';
import { UserEditComponent } from './components/user-edit/user-edit.component';
import { ErrorComponent } from './components/error/error.component';
import { BookingtypeComponent } from './components/bookingtype/bookingtype.component';
import { BookingComponent } from './components/booking/booking.component';

// rutas.
const appRoutes: Routes = [
  { path: '', component: LoginComponent },
  { path: 'inicio', component: HomeComponent },
  { path: 'login', component: LoginComponent },
  { path: 'logout/:sure', component: LoginComponent },
  { path: 'registro', component: RegisterComponent },
  { path: 'crear-tipo-reserva', component: BookingtypeComponent },
  { path: 'crear-reservacion', component: BookingComponent },
  { path: 'ajustes', component: UserEditComponent },
  { path: '*', component: ErrorComponent },
];

// exportacionn de rutas.
@NgModule({
  imports: [RouterModule.forRoot(appRoutes)],
  exports: [RouterModule],
})
export class AppRoutingModule {}
