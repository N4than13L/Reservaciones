export class Booking{
    constructor(
        public id: number,
        public user_id: number,
        public booking_type_id: number,
        public name: string,
        public surname: string,
        public bio: string,
        public age: number,
        public nationality: string,
        public created_at: string,
    ){}
}