import {ModuleWithProviders} from '@angular/core';
import {Routes, RouterModule} from '@angular/router';
import {LoginComponent} from './components/login.component';
import {DefaultComponent} from './components/default.component';
import {HomeComponent} from './components/home.component';


const appRoutes: Routes = [
	{path:'', component			: DefaultComponent},
	{path:'index',component		: DefaultComponent},
	{path:'index/:page',component: DefaultComponent},
	{path:'login',component		: LoginComponent},
	{path:'login/:id',component	: LoginComponent},
	{path:'home',component		: HomeComponent},
	{path:'emp-data',component	: DefaultComponent},
	{path:'leave',component	    : DefaultComponent},
	{path:'**',component		: LoginComponent}
];

export const appRoutingProviders: any[] = [];
export const routing: ModuleWithProviders = RouterModule.forRoot(appRoutes);