import {Injectable} from '@angular/core';
import {Http, Request} from '@angular/http';
import {Observable} from 'rxjs/Observable';

import {BaseService} from './BaseService';
import 'rxjs/Rx';

@Injectable()
export class PageService extends BaseService{
    
    constructor(private _http: Http) {
        super();
    }
    
    getTitles() {
        return this._http.get('/api/services/page-titles')
                         .map(res => res.json())
                         .catch(this.handleError);
    }
    
    getPage(pageId: number) {
        return this._http.get('/api/services/page/' + pageId)
                         .map(res => res.json())
                         .catch(this.handleError);
    }
}