import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { dispatch } from '@angular-redux/store';

@Injectable()
export class AppActions {

    constructor(
        private http: HttpClient
    ) { }

    @dispatch()
    request() {
        return dispatch => {
            this.http.get('https://jsonplaceholder.typicode.com/posts').toPromise().then(
                response => {
                    dispatch({
                        type: 'REQUEST_SUCCESS',
                        payload: response
                    })
                },
                rejection => {
                    dispatch({
                        type: 'REQUEST_FAIL',
                        payload: rejection
                    })
                }
            )
        }
    }
}