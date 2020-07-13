import {Component, OnInit} from '@angular/core';
import {Router, ActivatedRoute, Params} from '@angular/router';
import {UserService} from '../services/user.service';


@Component({
	selector: 'default',
	templateUrl: '../views/default.html',
	providers: [UserService]
})
export class DefaultComponent implements OnInit{
	public title: string;
	public identity;
	public token;
	public pages;
	public pagePrev;
	public pageNext;
	public loading;

	constructor(
		private _route	: ActivatedRoute,
		private _router	: Router,
		private _userService: UserService,
		
	){
		this.title = 'Homepage';
		this.identity = this._userService.getIdentity();
		this.token = this._userService.getToken();
	}

	ngOnInit(){
		//console.log('Default component created!');
		

	}

}