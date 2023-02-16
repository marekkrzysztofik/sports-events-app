
export const disciplines1 = [
    {
        sports: ["swimming", "running"],
    },
    {
        name: "Swimming",
        styles: [
            { cname: "freestyle" },
            { cname: "backstroke" },
            { cname: "breaststroke" },
            { cname: "butterfly" },
        ],
        competitions: [{ cname: "50m" }, { cname: "100m" }, { cname: "200m" }],
    },
    {
        name: "Running",
        styles: [{ cname: "track" }, { cname: "cross-country" }],
        competitions: [
            { cname: "50m" },
            { cname: "400m" },
            { cname: "1000m" },
            { cname: "2000m" },
        ],
    },
];

// const disciplines = {
//     sports: ["swimming", "running"],
//     swimming: {
//         styles: ["freestyle", "backstroke", "breaststroke", "butterfly"],
//         competitions: ["50m", "100m", "200m"],
//     },
//     running: {
//         styles: ["track", "cross-country"],
//         competitions: ["50m", "400m", "1000m", "2000m"],
//     },
// };

export const ageCategories = [
    "9-11 years",
    "11-13 years",
    "13-15 years",
    "15-17 years",
    "17-18 years",
    "18-22 years",
    "22+ years",
];
export const sex = ["M", "F"];
export const sports = disciplines1[0].sports;

//export const swimStyles = disciplines.swimming.styles;
// export const swimComp = disciplines.sport[0].swimming.competitions;
// export const runningStyles = disciplines.sport[1].running.styles;
// export const runningComp = disciplines.sport[1].running.competitions;
