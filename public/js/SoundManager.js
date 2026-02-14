document.addEventListener('alpine:init', () => {
    Alpine.data('soundManager', () => ({
        sounds: {},
        isMuted: localStorage.getItem('isMuted') === 'true',

        init() {
            // Preload common sounds
            this.loadSound('click', '/sounds/click.mp3');
            this.loadSound('success', '/sounds/success.mp3');
            this.loadSound('fanfare', '/sounds/fanfare.mp3');
            this.loadSound('error', '/sounds/error.mp3');
            this.loadSound('level-up', '/sounds/level-up.mp3');
            this.loadSound('hover', '/sounds/hover.mp3');

            // Listen for global events
            window.addEventListener('play-sound', (e) => {
                this.play(e.detail.sound);
            });

            // Listen for hover sounds on elements with .sound-hover class
            document.addEventListener('mouseenter', (e) => {
                if (e.target.matches('.sound-hover')) {
                    this.play('hover');
                }
            }, true);

            // Listen for click sounds on elements with .sound-click class
            document.addEventListener('click', (e) => {
                if (e.target.matches('.sound-click') || e.target.closest('.sound-click')) {
                    this.play('click');
                }
            }, true);
        },

        loadSound(name, path) {
            this.sounds[name] = new Audio(path);
        },

        play(name) {
            if (this.isMuted) return;

            if (this.sounds[name]) {
                const sound = this.sounds[name].cloneNode(); // Allow overlapping sounds
                sound.volume = 0.5; // Default volume
                sound.play().catch(e => console.log('Audio play failed:', e));
            } else {
                console.warn(`Sound "${name}" not found`);
            }
        },

        toggleMute() {
            this.isMuted = !this.isMuted;
            localStorage.setItem('isMuted', this.isMuted);
        }
    }))
});
