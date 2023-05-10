import { Component } from '@angular/core';
import { User } from 'src/app/models/user';
import { UserService } from 'src/app/service/user.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css'],
  providers: [UserService],
})
export class LoginComponent {
  public page_title: string;
  public user: User;
  public status: string;

  public token: any;
  public identity: any;

  constructor(public _userService: UserService) {
    this.page_title = 'Identificate';
    this.status = '';
    this.user = new User(1, '', '', 'ROLE_USER', '', '', '', '');
  }
  ngOnInit() {}

  onSubmit(login: any) {
    this._userService.signup(this.user).subscribe(
      (response) => {
        // sacar token.
        if (response.status != 'error') {
          this.status = 'success';
          this.token = response;

          // usuario identificado.
          this._userService.signup(this.user, true).subscribe(
            (response) => {
              this.identity = response;

              console.log(this.token);
              console.log(this.identity);

              /*
              persistir datos del usuario 
              (en el localstorage)*/
              localStorage.setItem('token', this.token);
              localStorage.setItem('identity', JSON.stringify(this.identity));
            },
            (error) => {
              this.status = 'error';
              console.log(<any>error);
            }
          );
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
