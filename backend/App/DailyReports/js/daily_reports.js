const is_start = (obj) => {
    if (obj.getAttribute('value') === "出勤") {
        obj.setAttribute('value', "退勤");
        return;
    } 

    if (obj.getAttribute('value') === "退勤") {
        const is_end = () => confirm('退勤しますか?');
        
        if (!is_end()) return;

        obj.setAttribute('value', "出勤");
        return;
    }
}
