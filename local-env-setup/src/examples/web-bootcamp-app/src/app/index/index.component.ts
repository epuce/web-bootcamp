import { Component, OnInit } from '@angular/core';
import { FormControl, Validators, FormGroup } from '@angular/forms';

@Component({
  selector: 'app-index',
  templateUrl: './index.component.html',
  styleUrls: ['./index.component.css']
})
export class IndexComponent implements OnInit {
  form: FormGroup;
  user = {
    name: '',
    isActive: false
  }

  controls = {
    name: new FormControl('', [Validators.required]),
    isActive: new FormControl()
  }

  constructor() { }

  ngOnInit(): void {
    this.form = new FormGroup(this.controls);

    this.form.valueChanges.subscribe((values) => {
      console.log(this.form)
    })
  }

}
