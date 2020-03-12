import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { dispatch } from '@angular-redux/store';

@Injectable()
export class AppActions {

    constructor(
        private http: HttpClient
    ) { }

    @dispatch()
    loadList() {
        return dispatch => {
            this.http.get('https://restcountries.eu/rest/v2/currency/usd').toPromise().then((response) => {
                dispatch({
                    type: 'LOAD_LIST',
                    payload: response
                })
              })
        }
    }

    @dispatch()
    copyRow(index) {
        return {
            type: 'COPY_ROW',
            payload: {
                index: index
            }
        }
    }

    @dispatch()
    deleteRow(index) {
        return {
            type: 'DELETE_ROW',
            payload: {
                index: index
            }
        }
    }

    @dispatch()
    showRefreshBtn() {
        return {
            type: 'SHOW_REFRESH_BTN'
        }
    }

    @dispatch()
    hideRefreshBtn() {
        return {
            type: 'HIDE_REFRESH_BTN'
        }
    }
}