
window.onscroll = () => {
    var tabs = document.querySelectorAll('.cstm-subform .fl-accordion-content h2');
    var h2List = document.querySelectorAll('.cstm-blog h2')
    var y = window.pageYOffset;
    var color = 'red';

    for (let index = 0; index < h2List.length; index++) {
        const element = h2List[index];
        var offset = element.offsetTop + 49;
        if(y >= offset) {
        reset()
            tabs[index].style.background = color;
        }
            
    }

   
}

function reset() {
    var tabs = document.querySelectorAll('.cstm-subform .fl-accordion-content h2');
    tabs.forEach(tab => tab.removeAttribute('style'));
}



   






    
    // if(y > 731 && y < 866) {
    //     reset()
    //     tabs[1].style.background = color;
    // }
    // if(y > 865 && y < 1228) {
    //     reset()
    //     tabs[2].style.background = color;
    // }
    // if(y > 1227 && y < 1430) {
    //     reset()
    //     tabs[3].style.background = color;
    // }
    // if(y > 1429 && y < 1783) {
    //     reset()
    //     tabs[4].style.background = color;
    // }
    // if(y > 1782 && y < 2350) {
    //     reset()
    //     tabs[5].style.background = color;
    // }
    // if(y > 2349 && y < 3437) {
    //     reset()
    //     tabs[6].style.background = color;
    // }
    // if(y > 3436 && y < 4090) {
    //     reset()
    //     tabs[7].style.background = color;
    // }
    // if(y > 4089 && y < 5916) {
    //     reset()
    //     tabs[8].style.background = color;
    // }
    // if(y > 5915) {
    //     reset()
    //     tabs[9].style.background = color;
    // }
