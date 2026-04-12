export class EditorialModel {
    constructor(
        public editorial_id: number,
        public tel_number: String,
        public created_at: Date,
        public updated_at: Date,
        public deleted_at: Date
    ){}
}
