import { Component } from '@angular/core';
import { Router, ActivatedRoute, Params } from '@angular/router';
import { UserService } from 'src/app/service/user.service';
import { BookingTypeService } from 'src/app/service/bookingtype.service';
import { BookingService } from 'src/app/service/booking.service';
import { Booking } from 'src/app/models/booking';

@Component({
  selector: 'app-booking',
  templateUrl: './booking.component.html',
  styleUrls: ['./booking.component.css'],
  providers: [UserService, BookingTypeService, BookingService],
})
export class BookingComponent {
  public page_title: string;
  public identity: any;
  public token: any;
  public booking: Booking;
  public status: string;
  public bookings: any;

  constructor(
    private _userService: UserService,
    private _bookingTypeService: BookingTypeService,
    private _bookingService: BookingService,
    private _router: Router,
    private _route: ActivatedRoute
  ) {
    this.page_title = 'Crea las reservas de los huespedes';
    this.identity = this._userService.getIdentity();
    this.token = this._userService.getToken();
    this.booking = new Booking(1, this.identity.sub, 1, '', '', '', 2, '', '');
    this.status = '';
  }

  ngOnInit(): void {
    this.getBookings();
    console.log(this._bookingService.testing());
  }

  onSubmit(form: any) {
    this._bookingService.create(this.token, this.booking).subscribe(
      (response) => {
        if (response.status == 'success') {
          this.booking = response.booking;
          this.status = 'success';
          // this._router.navigate(['/inicio']);
        } else {
          this.status = 'error';
        }
      },
      (error) => {
        console.log(error);
        this.status = 'error';
      }
    );
  }

  getBookings() {
    this._bookingTypeService.getBooking_types().subscribe(
      (response) => {
        if (response.status == 'success') {
          this.bookings = response.booking_type;
          // console.log(response);
        } else {
          this.status = 'error';
        }
      },
      (error) => {
        this.status = 'error';
        console.log(<any>error);
      }
    );
  }
}
