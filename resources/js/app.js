import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;



window.countdown = (deadline) => ({
    deadline: new Date(deadline),
    remaining: '',
    interval: null,
    init() {
        this.update();
        this.interval = setInterval(() => this.update(), 1000);
    },
    update() {
        const diff = this.deadline - new Date();
        if (diff <= 0) {
            this.remaining = '00:00:00';
            clearInterval(this.interval);
            return;
        }
        let totalSeconds = Math.floor(diff / 1000);
        const days = Math.floor(totalSeconds / 86400);
        totalSeconds %= 86400;
        const hours = Math.floor(totalSeconds / 3600);
        totalSeconds %= 3600;
        const minutes = Math.floor(totalSeconds / 60);
        const seconds = totalSeconds % 60;
        const hms = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        this.remaining = days > 0 ? `${days}d ${hms}` : hms;
    },
    color() {
        const diffHours = (this.deadline - new Date()) / 3600000;
        if (diffHours < 3) return 'text-red-600';
        if (diffHours < 12) return 'text-yellow-500';
        return 'text-green-600';
    },
    showAlert() {
        return (this.deadline - new Date()) / 3600000 < 1;
    },
});

Alpine.start();
