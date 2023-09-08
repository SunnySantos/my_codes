const cat = [
    {
        name: 'Category 1',
        children: [
            {
                name: 'Category 1 - 1',
                children: [
                    {
                        name: 'Category 1 - 1 - 1'
                    },
                    {
                        name: 'Category 1 - 1 - 2'
                    },
                    {
                        name: 'Category 1 - 1 - 3'
                    }
                ]
            },
            {
                name: 'Category 1 - 2',
                children: [
                    {
                        name: 'Category 1 - 2 - 1'
                    },
                    {
                        name: 'Category 1 - 2 - 2',
                        children: [
                            {
                                name: 'Category 1 - 2 - 2 - 1'
                            }
                        ]
                    }
                ]
            }
        ]
    },
    {
        name: 'Category 2',
        children: [
            {
                name: 'Category 2 - 1'
            }
        ]
    }
]

function recursion(c, i = 0) {
    if (c[i] == undefined || c[i] == null) return
    console.log(c[i].name);
    if (c[i].children) recursion(c[i].children);
    return recursion(c, ++i);
}

// recursion(cat)



const arr = [1, [2, 3], [4, [5, 6]]];
const cb = (num) => num * 2;

deepFilterMap(arr, cb); // should return [2, 4, 6, 8, 10, 12]

function deepFilterMap(a, c) {
    console.log(a.map(v => {
        if(typeof v == 'object') return deepFilterMap(v,c);
        return c(v)
    }));
}