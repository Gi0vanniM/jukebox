export const helperMixin = {
    methods: {
        secondsToTime(seconds) {
            return new Date(seconds * 1000)
                .toISOString()
                .substr(11, 8)
                .replace(/^0(?:0:0?)?/, "");
        },
        exists: function (elId) {
            if (document.getElementById(elId)) {
                return true;
            }
            return false;
        },
    }
}