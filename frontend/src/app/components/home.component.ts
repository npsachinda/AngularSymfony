import {Component, OnInit} from '@angular/core';
import {Router, ActivatedRoute, Params} from '@angular/router'; 
import {UserService} from '../services/user.service';
import {User} from '../models/user';



@Component({
	selector: 'home',
	templateUrl: '../views/home.html',
	providers: [UserService]
})
export class HomeComponent implements OnInit{
	public page_title: string;
	public identity;
	public token;
	public user:User;
	public loading;

	constructor(
		private _route: ActivatedRoute,
		private _router: Router,
		private _userService: UserService
	
	){
		this.page_title = 'User Information';
		this.identity = this._userService.getIdentity();
		this.token = this._userService.getToken();
	}

	ngOnInit(){
		if(this.identity && this.identity.sub){
			//call the user service
			this.getUserInfo();
		}else{
			this._router.navigate(['/login']);
		}
	}

	getUserInfo(){
		this.loading = 'show';
		let id = this.identity.sub;
		

			this._userService.getUserInfo(this.token, id).subscribe(
				response => {
					
					if(response.status == 'success'){
						
						if(response.user_id == this.identity.sub){
							this.user = response.data;

							console.log(this.user);

							this.loading = 'hide';
						}else{
							this._router.navigate(['/home']);
						}

					}else{
						this._router.navigate(['/login']);
					}
				},
				error => {
					console.log(<any>error);
				}
			);
		
	}

}