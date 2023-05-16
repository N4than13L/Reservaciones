import { Component } from '@angular/core';
import { Booking } from 'src/app/models/booking';
import { BookingService } from 'src/app/service/booking.service';
import { Global } from 'src/app/service/global';
import { UserService } from 'src/app/service/user.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css'],
  providers: [BookingService, UserService],
})
export class HomeComponent {
  public page_title: string;
  public url: string;
  public status: string = '';
  public bookings: Array<Booking> | any;
  public identity: any;
  public token: any;

  constructor(
    private _bookingService: BookingService,
    private _userService: UserService
  ) {
    this.page_title = 'Inicio';
    this.url = Global.url;
    // this.bookings = [];
    this.identity = this._userService.getIdentity();
    this.token = this._userService.getToken();
  }
  ngOnInit(): void {
    this.getBokings();
  }

  getBokings() {
    this._bookingService.getBookings().subscribe(
      (response) => {
        if (response.status == 'success') {
          this.bookings = response.bookings;
          console.log(this.bookings);
        }
      },
      (error) => {
        console.log(<any>error);
      }
    );
  }
}
