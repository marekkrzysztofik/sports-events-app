export interface DisciplineForm {
    name: string;
    user_id: number;
    minAge: number;
    maxAge: number;
    style: string;
    competition: string;
    startTime: string;
    sex: string;
    participants: number;
    timeNotScore: number;
    bigScoreWins: number;
}
export interface Date {
    day: string;
    time: string;
}
export interface CompStyle {
    style: {
        cname: string;
    };
    competition: {
        cname: string;
    };
}
