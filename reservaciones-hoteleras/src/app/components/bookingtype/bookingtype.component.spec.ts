import { ComponentFixture, TestBed } from '@angular/core/testing';

import { BookingtypeComponent } from './bookingtype.component';

describe('BookingtypeComponent', () => {
  let component: BookingtypeComponent;
  let fixture: ComponentFixture<BookingtypeComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ BookingtypeComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(BookingtypeComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
