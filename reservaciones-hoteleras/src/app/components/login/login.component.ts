import { Component } from '@angular/core';
import { User } from 'src/app/models/user';
import { UserService } from 'src/app/service/user.service';
import { Router, ActivatedRoute, Params } from '@angular/router';

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

  constructor(
    public _userService: UserService,
    private _router: Router,
    private _route: ActivatedRoute
  ) {
    this.page_title = 'Identificate';
    this.status = '';
    this.user = new User(1, '', '', 'ROLE_USER', '', '', '', '');
  }
  ngOnInit() {
    this.logout();
  }

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

              // console.log(this.token);
              // console.log(this.identity);

              login.reset();

              /*
              persistir datos del usuario 
              (en el localstorage)*/
              localStorage.setItem('token', this.token);
              localStorage.setItem('identity', JSON.stringify(this.identity));

              // redireccion a inicio.
              this._router.navigate(['/inicio']);
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

  logout() {
    this._route.params.subscribe((params) => {
      let logout = +params['sure'];
      if (logout == 1) {
        localStorage.removeItem('identity');
        localStorage.removeItem('token');
        this.identity = null;
        this.token = null;

        // redireccion a inicio.
        this._router.navigate(['/inicio']);
      }
    });
  }
}
