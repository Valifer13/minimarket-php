<?php 
function formatTimeAgo($timestamp) {
    $diff = time() - $timestamp;

    if ($diff < 60) {
        return $diff . " seconds ago";
    } elseif ($diff < 3600) {
        $minutes = round($diff / 60);
        return $minutes . " minute" . ($minutes > 1 ? "s" : "") . " ago";
    } elseif ($diff < 86400) {
        $hours = round($diff / 3600);
        return $hours . " hour" . ($hours > 1 ? "s" : "") . " ago";
    } elseif ($diff < 604800) { // Less than a week
        $days = round($diff / 86400);
        return $days . " day" . ($days > 1 ? "s" : "") . " ago";
    } elseif ($diff < 2600640) { // Less than a month
        $weeks = round($diff / 604800);
        return $weeks . " week" . ($weeks > 1 ? "s" : "") . " ago";
    } elseif ($diff < 31207680) { // Less than a year
        $months = round($diff / 2600640);
        return $months . " month" . ($months > 1 ? "s" : "") . " ago";
    } else {
        $years = round($diff / 31207680);
        return $years . " year" . ($years > 1 ? "s" : "") . " ago";
    }
}

function timeAgo($datetime, $full = false) {
    $tz = new DateTimeZone('Asia/Makassar'); // pastikan pakai WIB
    $now = new DateTime('now', $tz);
    $ago = new DateTime($datetime, $tz);

    $diff = $now->diff($ago);

    $string = [
        'y' => 'year',
        'm' => 'month',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    ];

    $values = [
        'y' => $diff->y,
        'm' => $diff->m,
        'd' => $diff->d,
        'h' => $diff->h,
        'i' => $diff->i,
        's' => $diff->s,
    ];

    foreach ($string as $k => &$v) {
        if ($values[$k]) {
            $v = $values[$k] . ' ' . $v . ($values[$k] > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}