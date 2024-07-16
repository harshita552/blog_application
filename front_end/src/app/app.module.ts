import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { RouterModule, Routes } from '@angular/router';
import { HttpClientModule } from '@angular/common/http';


import { AppComponent } from './app.component';
import { BlogListComponent } from './blog-list/blog-list.component';
import { BlogPostComponent } from './blog-post/blog-post.component';

// Define your routes
const routes: Routes = [
  { path: '', redirectTo: '/blogs', pathMatch: 'full' }, // Redirect to /blogs by default
  { path: 'blogs', component: BlogListComponent },
  { path: 'blog/:id', component: BlogPostComponent }
  // Add more routes as needed
];

@NgModule({
  declarations: [
    AppComponent,
    BlogListComponent,
    BlogPostComponent
  ],
  imports: [
    BrowserModule,
    HttpClientModule,  // Ensure this is imported
    RouterModule.forRoot(routes) // Configure the routes
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
