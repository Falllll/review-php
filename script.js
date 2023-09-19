javascript: (function () {
    let data = stage.pJsnData, strs = [],
        player = null, str = "";

    for (let i in data.multi_raid_member_info)
        str = "(" + (player = data.multi_raid_member_info[i]).rank + ") [r" + player.level + "][" + player.user_id + "] " + player.nickname + " - " + player.point.toLocaleString() + "pt. ", player.is_dead && (str += " DEAD "), player.is_host && (str += " HOST "), player.retired_flag && (str += " RETREATED "),
            strs.push(str);
    alert(strs.join("\n"));
})();