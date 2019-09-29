import { NgModule } from '@angular/core';
import { NgReduxModule, NgRedux } from '@angular-redux/store';
import { globalReducer } from './app.reducers';
import thunk from 'redux-thunk';

@NgModule({
  imports: [NgReduxModule],
  providers: [],
})
export class StoreModuleNgRedux {
  constructor(
    public store: NgRedux<any>
  ) {
    // Tell Redux about our reducers and epics. If the Redux DevTools
    // chrome extension is available in the browser, tell Redux about
    // it too.

    store.configureStore(
      globalReducer,
      {},
      [ thunk ],
      []);
  }
}
