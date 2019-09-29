import { combineReducers } from 'redux';
import { FluxStandardAction } from 'flux-standard-action';

export function listReducer(state = [], action: FluxStandardAction<string, any>) {
    switch (action.type) {
        case 'LOAD_LIST':
            return [
                ...action.payload
            ];
        case 'COPY_ROW':
            const index = action.payload.index;

            return [
                ...state.slice(0, index),
                state[index],
                ...state.slice(index),
            ]
        case 'DELETE_ROW':
            return state.filter((val, index) => index !== action.payload.index )
    }

    return state;
}

export function refreshBtnReducer(state = false, action: FluxStandardAction<string, any>) {
    switch (action.type) {
        case 'SHOW_REFRESH_BTN':
            return true;
        case 'HIDE_REFRESH_BTN':
            return false;
    }

    return state;
}


export const globalReducer = combineReducers({
    list: listReducer,
    refreshBtn: refreshBtnReducer,
});