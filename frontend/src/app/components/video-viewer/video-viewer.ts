import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';

type CarouselVideo = {
  src: string;
  title: string;
  description: string;
};

@Component({
  selector: 'app-video-viewer',
  imports: [CommonModule],
  templateUrl: './video-viewer.html',
  styleUrl: './video-viewer.css',
})
export class VideoViewer {
  videos: CarouselVideo[] = [
    {
      src: '/assets/videos/Prueba.mp4',
      title: 'Video destacado',
      description: 'Navega entre los videos con las flechas laterales.',
    },
  ];

  currentIndex = 0;

  get currentVideo(): CarouselVideo {
    return this.videos[this.currentIndex];
  }

  get videoUrl(): string {
    return this.currentVideo.src;
  }

  nextVideo(): void {
    this.currentIndex = (this.currentIndex + 1) % this.videos.length;
  }

  previousVideo(): void {
    this.currentIndex = (this.currentIndex - 1 + this.videos.length) % this.videos.length;
  }

  goToVideo(index: number): void {
    this.currentIndex = index;
  }
}