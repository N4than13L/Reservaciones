import { Component, OnInit, DoCheck } from '@angular/core';
import { UserService } from './service/user.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css'],
  providers: [UserService],
})
export class AppComponent implements OnInit, DoCheck {
  public title = 'reservaciones-hoteleras';
  public identity: any;
  public token: any;

  constructor(public _userService: UserService) {
    this.load();
  }

  ngOnInit(): void {
    console.log('app cargada');
  }

  ngDoCheck(): void {
    this.load();
  }

  load() {
    this.identity = this._userService.getIdentity();
    this.token = this._userService.getToken();
  }
}
