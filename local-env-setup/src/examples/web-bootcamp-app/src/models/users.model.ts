export class User {
    id: number;
    name: string;
    email: string;

    constructor($data) {
        this.id = $data['id'];
        this.email = $data['email'];
        this.name = $data['first_name'] + ' ' + $data['last_name']
    }
}