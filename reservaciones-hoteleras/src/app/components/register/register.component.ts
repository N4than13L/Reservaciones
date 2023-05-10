import { Component, OnInit } from '@angular/core';
import { User } from 'src/app/models/user';
import { UserService } from 'src/app/service/user.service';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css'],
  providers: [UserService],
})
export class RegisterComponent {
  public page_title: string;
  public status: string;
  public user: User;

  constructor(private _userService: UserService) {
    this.page_title = 'Registrate';
    this.status = '';
    this.user = new User(1, '', '', 'ROLE_USER', '', '', '', '');
  }

  ngOnInit() {}

  onSubmit(form: any) {
    this._userService.register(this.user).subscribe(
      (response) => {
        if (response.status == 'success') {
          this.status = response.status;
          console.log(response);
          form.reset();
        } else {
          this.status = 'error';
        }
      },
      (error) => {
        console.log(<any>error);
      }
    );
  }
}
