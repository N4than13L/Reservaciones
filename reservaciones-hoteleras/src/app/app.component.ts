import { Component, OnInit, DoCheck } from '@angular/core';
import { UserService } from './service/user.service';
import { BookingTypeService } from './service/bookingtype.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css'],
  providers: [UserService, BookingTypeService],
})
export class AppComponent implements OnInit, DoCheck {
  public title = 'reservaciones-hoteleras';
  public identity: any;
  public token: any;
  public status: string;
  public booking_types: any;

  constructor(
    public _userService: UserService,
    private _bookingTypService: BookingTypeService
  ) {
    this.load();
    this.status = '';
  }

  ngOnInit(): void {
    console.log('app cargada');
    // this.getBookingtypes();
  }

  ngDoCheck(): void {
    this.load();
  }

  load() {
    this.identity = this._userService.getIdentity();
    this.token = this._userService.getToken();
  }

  getBookingtypes() {
    this._bookingTypService.getBooking_types().subscribe(
      (response) => {
        if (response.status == 'success') {
          this.booking_types = response.booking_types;
          console.log(this.booking_types);
        }
      },
      (error) => {
        console.log(error);
      }
    );
  }
}
