class AsideCarousel {
    constructor(container) {
        this.container = container;
        this.slides = Array.from(container.querySelectorAll('.aside-carousel-slide'));
        this.totalSlides = this.slides.length;
        this.currentSlide = 0;
        this.autoplayInterval = null;
        this.autoplayDelay = 4000; // 4 seconds between slides
        this.isTransitioning = false;
        this.modalCurrentSlide = 0;

        this.init();
    }

    init() {
        this.createControls();
        this.createModal();
        this.showSlide(0);
        this.startAutoplay();
        this.setupEventListeners();
        // Disable auto height adjustment to keep the fixed height
        // this.adjustHeight();
    }

    createControls() {
        // Create navigation buttons (hidden by default via CSS)
        const prevButton = document.createElement('button');
        prevButton.className = 'aside-carousel-button prev';
        prevButton.innerHTML = '<i class="fas fa-chevron-left"></i>';
        prevButton.addEventListener('click', (e) => {
            e.stopPropagation();
            this.prevSlide();
        });

        const nextButton = document.createElement('button');
        nextButton.className = 'aside-carousel-button next';
        nextButton.innerHTML = '<i class="fas fa-chevron-right"></i>';
        nextButton.addEventListener('click', (e) => {
            e.stopPropagation();
            this.nextSlide();
        });

        // Create indicators
        const dotsContainer = document.createElement('div');
        dotsContainer.className = 'aside-carousel-controls';
        
        for (let i = 0; i < this.totalSlides; i++) {
            const dot = document.createElement('div');
            dot.className = 'aside-carousel-dot';
            dot.addEventListener('click', (e) => {
                e.stopPropagation();
                this.showSlide(i);
            });
            dotsContainer.appendChild(dot);
        }

        this.container.appendChild(prevButton);
        this.container.appendChild(nextButton);
        this.container.appendChild(dotsContainer);
    }

    createModal() {
        // Create modal for expanded image view
        this.modal = document.createElement('div');
        this.modal.className = 'image-modal';
        
        // Close button
        const closeBtn = document.createElement('span');
        closeBtn.className = 'close-modal';
        closeBtn.innerHTML = '&times;';
        closeBtn.addEventListener('click', () => this.closeModal());
        
        // Modal image
        this.modalImg = document.createElement('img');
        this.modalImg.className = 'modal-content';
        
        // Navigation buttons
        const prevBtn = document.createElement('div');
        prevBtn.className = 'modal-nav modal-prev';
        prevBtn.innerHTML = '&#10094;';
        prevBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            this.prevModalSlide();
        });
        
        const nextBtn = document.createElement('div');
        nextBtn.className = 'modal-nav modal-next';
        nextBtn.innerHTML = '&#10095;';
        nextBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            this.nextModalSlide();
        });
        
        // Append elements to modal
        this.modal.appendChild(closeBtn);
        this.modal.appendChild(this.modalImg);
        this.modal.appendChild(prevBtn);
        this.modal.appendChild(nextBtn);
        
        // Add modal to document body
        document.body.appendChild(this.modal);
        
        // Close modal when clicking outside the image
        this.modal.addEventListener('click', (e) => {
            if (e.target === this.modal) {
                this.closeModal();
            }
        });
        
        // Handle keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (!this.modal.classList.contains('show')) return;
            
            if (e.key === 'Escape') {
                this.closeModal();
            } else if (e.key === 'ArrowLeft') {
                this.prevModalSlide();
            } else if (e.key === 'ArrowRight') {
                this.nextModalSlide();
            }
        });
    }

    setupEventListeners() {
        // Mouse events
        this.container.addEventListener('mouseenter', () => this.stopAutoplay());
        this.container.addEventListener('mouseleave', () => this.startAutoplay());
        
        // Touch events
        let touchStartX = 0;
        let touchEndX = 0;
        
        this.container.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });
        
        this.container.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            this.handleSwipe(touchStartX, touchEndX);
        }, { passive: true });

        // Window resize event - disabled to maintain fixed height
        // window.addEventListener('resize', () => this.adjustHeight());

        // Image load events - disabled to maintain fixed height
        // this.slides.forEach(slide => {
        //     const img = slide.querySelector('img');
        //     if (img) {
        //         img.addEventListener('load', () => this.adjustHeight());
        //     }
        // });

        // Click event to open modal
        this.slides.forEach((slide, index) => {
            slide.addEventListener('click', () => {
                this.openModal(index);
            });
        });
    }

    // Method disabled to maintain fixed height
    adjustHeight() {
        // This method is now disabled to maintain the fixed height set in CSS
        return;
    }

    showSlide(index) {
        if (this.isTransitioning) return;
        this.isTransitioning = true;

        this.slides.forEach(slide => slide.classList.remove('active'));
        const dots = this.container.querySelectorAll('.aside-carousel-dot');
        dots.forEach(dot => dot.classList.remove('active'));
        
        dots[index].classList.add('active');
        this.slides[index].classList.add('active');
        this.currentSlide = index;

        // Adjust height for the new slide - disabled to maintain fixed height
        // this.adjustHeight();

        setTimeout(() => {
            this.isTransitioning = false;
        }, 500);
    }

    nextSlide() {
        if (this.isTransitioning) return;
        const next = (this.currentSlide + 1) % this.totalSlides;
        this.showSlide(next);
    }

    prevSlide() {
        if (this.isTransitioning) return;
        const prev = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
        this.showSlide(prev);
    }

    startAutoplay() {
        if (this.autoplayInterval) return;
        this.autoplayInterval = setInterval(() => this.nextSlide(), this.autoplayDelay);
    }

    stopAutoplay() {
        if (this.autoplayInterval) {
            clearInterval(this.autoplayInterval);
            this.autoplayInterval = null;
        }
    }

    handleSwipe(startX, endX) {
        const diff = startX - endX;
        if (Math.abs(diff) > 50) {
            if (diff > 0) {
                this.nextSlide();
            } else {
                this.prevSlide();
            }
        }
    }

    // Modal functions
    openModal(index) {
        // Stop autoplay when modal is open
        this.stopAutoplay();
        
        // Set current modal slide
        this.modalCurrentSlide = index;
        
        // Get image source from the slide
        const img = this.slides[index].querySelector('img');
        if (img) {
            this.modalImg.src = img.src;
            this.modalImg.alt = img.alt;
            
            // Show modal with animation
            this.modal.classList.add('show');
            
            // Prevent body scrolling
            document.body.style.overflow = 'hidden';
        }
    }
    
    closeModal() {
        this.modal.classList.remove('show');
        
        // Re-enable body scrolling
        document.body.style.overflow = '';
        
        // Restart autoplay
        this.startAutoplay();
    }
    
    nextModalSlide() {
        this.modalCurrentSlide = (this.modalCurrentSlide + 1) % this.totalSlides;
        this.updateModalImage();
    }
    
    prevModalSlide() {
        this.modalCurrentSlide = (this.modalCurrentSlide - 1 + this.totalSlides) % this.totalSlides;
        this.updateModalImage();
    }
    
    updateModalImage() {
        const img = this.slides[this.modalCurrentSlide].querySelector('img');
        if (img) {
            // Add a fade effect
            this.modalImg.style.opacity = '0';
            
            setTimeout(() => {
                this.modalImg.src = img.src;
                this.modalImg.alt = img.alt;
                this.modalImg.style.opacity = '1';
            }, 200);
        }
    }
}

// Initialize all aside carousels when the DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    const carousels = document.querySelectorAll('.aside-carousel');
    carousels.forEach(carousel => {
        new AsideCarousel(carousel);
    });
});