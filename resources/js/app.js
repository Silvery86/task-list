import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;



window.countdown = (deadline, startDate) => ({
    deadline: new Date(deadline),
    startDate: new Date(startDate),
    remaining: '',
    totalDuration: 0,
    remainingSeconds: 0,
    interval: null,
    init() {
        this.totalDuration = Math.floor((this.deadline - this.startDate) / 1000);
        this.update();
        this.interval = setInterval(() => this.update(), 1000);
    },
    update() {
        const diff = this.deadline - new Date();
        this.remainingSeconds = Math.max(0, Math.floor(diff / 1000));
        if (diff <= 0) {
            this.remaining = '00:00:00';
            clearInterval(this.interval);
            return;
        }
        let totalSeconds = this.remainingSeconds;
        const days = Math.floor(totalSeconds / 86400);
        totalSeconds %= 86400;
        const hours = Math.floor(totalSeconds / 3600);
        totalSeconds %= 3600;
        const minutes = Math.floor(totalSeconds / 60);
        const seconds = totalSeconds % 60;
        const hms = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        this.remaining = days > 0 ? `${days}d ${hms}` : hms;
    },
    total() {
        let total = this.totalDuration;
        const days = Math.floor(total / 86400);
        total %= 86400;
        const hours = Math.floor(total / 3600);
        total %= 3600;
        const minutes = Math.floor(total / 60);
        const seconds = total % 60;
        const hms = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        return days > 0 ? `${days}d ${hms}` : hms;
    },
    progressPercent() {
        if (this.totalDuration === 0) return 0;
        return Math.max(0, Math.min(100, ((this.remainingSeconds / this.totalDuration) * 100).toFixed(2)));
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
