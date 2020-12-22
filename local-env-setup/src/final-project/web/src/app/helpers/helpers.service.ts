import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class HelpersService {

  constructor() { }

  static getApiBaseHref() {
    return location.origin + '/final-project/api';
  }
}
