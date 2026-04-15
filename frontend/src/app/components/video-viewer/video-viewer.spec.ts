import { ComponentFixture, TestBed } from '@angular/core/testing';

import { VideoViewer } from './video-viewer';

describe('VideoViewer', () => {
  let component: VideoViewer;
  let fixture: ComponentFixture<VideoViewer>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [VideoViewer]
    })
    .compileComponents();

    fixture = TestBed.createComponent(VideoViewer);
    component = fixture.componentInstance;
    await fixture.whenStable();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
