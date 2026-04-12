export class BookModel {
    constructor(
        public isbn: string,
        public title: string,
        public description: string,
        public edition_num: string,
        public language: string,
        public price: number,
        public cover_image: string,
        public editorial_id: number,
        public created_at: Date,
        public updated_at: Date,
        public deleted_at: Date
    ){}
}
