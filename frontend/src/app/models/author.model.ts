export class AuthorModel {
    constructor(
        public author_id: number,
        public full_name: string,
        public gender: string,
        public country: string,
        public birth_date: Date,
        public death_date: Date,
        public created_at: Date,
        public updated_at: Date,
        public deleted_at: Date
    ){}
}
