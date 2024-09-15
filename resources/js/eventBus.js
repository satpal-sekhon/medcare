import { reactive } from 'vue';

export const eventBus = reactive({
    events: {}
});

export function emit(eventName, data) {
    if (!eventBus.events[eventName]) {
        eventBus.events[eventName] = [];
    }
    eventBus.events[eventName].forEach(callback => callback(data));
}

export function on(eventName, callback) {
    if (!eventBus.events[eventName]) {
        eventBus.events[eventName] = [];
    }
    eventBus.events[eventName].push(callback);
}

export function off(eventName, callback) {
    const callbacks = eventBus.events[eventName];
    if (callbacks) {
        eventBus.events[eventName] = callbacks.filter(cb => cb !== callback);
    }
}
