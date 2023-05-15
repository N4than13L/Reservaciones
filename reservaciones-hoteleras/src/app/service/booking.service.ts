import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Booking } from '../models/booking';
import { Global } from './global';

@Injectable()
export class BookingService {
  public url: string;
  public token: any;
  public identity: any;

  constructor(public _http: HttpClient) {
    this.url = Global.url;
  }

  testing() {
    return 'Hola mundo con servicio de reservaciones';
  }

  create(token: any, booking: any): Observable<any> {
    let json = JSON.stringify(booking);
    let params = 'json=' + json;
    let headers = new HttpHeaders()
      .set('Content-Type', 'application/x-www-form-urlencoded')
      .set('Authorization', token);

    return this._http.post(this.url + 'booking', params, { headers: headers });
  }

  getBookings(): Observable<any> {
    let headers = new HttpHeaders().set(
      'Content-Type',
      'application/x-www-form-urlencoded'
    );

    return this._http.get(this.url + 'booking', { headers: headers });
  }
}
