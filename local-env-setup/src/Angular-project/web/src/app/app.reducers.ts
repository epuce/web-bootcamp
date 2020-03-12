import { combineReducers } from 'redux';
import { FluxStandardAction } from 'flux-standard-action';

export function requestReducer(state = [], action: FluxStandardAction<string, any>) {
    switch (action.type) {
        case 'REQUEST_SUCCESS':
            return [
                ...action.payload
            ];
    }

    return state;
}

export const globalReducer = combineReducers({
    request: requestReducer,
});
