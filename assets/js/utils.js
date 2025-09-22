export function timeAgo(datetime, full = false) {
    const tz = 'Asia/Makassar'; // pastikan pakai WIB
    const now = new Date().toLocaleString("en-US", { timeZone: tz });
    const ago = new Date(datetime).toLocaleString("en-US", { timeZone: tz });

    const nowDate = new Date(now);
    const agoDate = new Date(ago);
    const diff = {
        y: nowDate.getFullYear() - agoDate.getFullYear(),
        m: nowDate.getMonth() - agoDate.getMonth(),
        d: nowDate.getDate() - agoDate.getDate(),
        h: nowDate.getHours() - agoDate.getHours(),
        i: nowDate.getMinutes() - agoDate.getMinutes(),
        s: nowDate.getSeconds() - agoDate.getSeconds(),
    };

    const string = {
        y: 'year',
        m: 'month',
        d: 'day',
        h: 'hour',
        i: 'minute',
        s: 'second',
    };

    const values = {
        y: diff.y,
        m: diff.m,
        d: diff.d,
        h: diff.h,
        i: diff.i,
        s: diff.s,
    };

    for (const k in string) {
        if (values[k]) {
            string[k] = values[k] + ' ' + string[k] + (values[k] > 1 ? 's' : '');
        } else {
            delete string[k];
        }
    }

    const result = full ? string : Object.keys(string).slice(0, 1).reduce((obj, key) => {
        obj[key] = string[key];
        return obj;
    }, {});

    return Object.keys(result).length ? Object.values(result).join(', ') + ' ago' : 'just now';
}