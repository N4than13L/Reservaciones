import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { BookingType } from '../models/bookingtype';
import { Global } from './global';

@Injectable()
export class BookingTypeService {
  public url: string;
  public token: any;
  public identity: any;

  constructor(public _http: HttpClient) {
    this.url = Global.url;
  }
  create(token: any, bookingtype: any): Observable<any> {
    let json = JSON.stringify(bookingtype);
    let params = 'json=' + json;
    let headers = new HttpHeaders()
      .set('Content-Type', 'application/x-www-form-urlencoded')
      .set('Authorization', token);

    return this._http.post(this.url + 'booking_type', params, {
      headers: headers,
    });
  }

  getBooking_types(): Observable<any> {
    let headers = new HttpHeaders().set(
      'Content-Type',
      'application/x-www-form-urlencoded'
    );

    return this._http.get(this.url + 'booking_type', { headers: headers });
  }
}
