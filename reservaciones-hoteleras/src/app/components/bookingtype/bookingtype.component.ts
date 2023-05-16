import { Component } from '@angular/core';
import { UserService } from 'src/app/service/user.service';
import { BookingTypeService } from 'src/app/service/bookingtype.service';
import { BookingType } from 'src/app/models/bookingtype';
import { ActivatedRoute, Router, Params } from '@angular/router';

@Component({
  selector: 'app-bookingtype',
  templateUrl: './bookingtype.component.html',
  styleUrls: ['./bookingtype.component.css'],
  providers: [UserService, BookingTypeService],
})
export class BookingtypeComponent {
  public page_title: string;
  public identity: any;
  public token: any;
  public bookingtype: BookingType;
  public status: string;
  public booking_types: any;

  constructor(
    private _router: Router,
    private _route: ActivatedRoute,
    private _userService: UserService,
    private _bookingTypeService: BookingTypeService
  ) {
    this.page_title = 'crear tipo de reservas';
    this.bookingtype = new BookingType(1, '');
    this.status = '';
    this.identity = this._userService.getIdentity();
    this.token = this._userService.getToken();
  }

  onSubmit(form: any) {
    this._bookingTypeService.create(this.token, this.bookingtype).subscribe(
      (response) => {
        if (response.status == 'success') {
          this.bookingtype = response.booking_type;
          this.status = 'success';
          this._router.navigate(['/crear-tipo-reserva']);
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

  ngOnInit(): void {
    this.getBookingtypes();
  }

  getBookingtypes() {
    this._bookingTypeService.getBooking_types().subscribe(
      (response) => {
        if (response.status == 'success') {
          this.booking_types = response.booking_type;
          console.log(this.booking_types);
        }
      },
      (error) => {
        console.log(error);
      }
    );
  }
}
