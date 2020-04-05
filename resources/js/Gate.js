export default class Gate {
    constructor(user) {
        this.user = user;
    }
    isAdmin() {
        return this.user.type === 'admin';
    }
    isUser() {
        return this.user.type === 'user';
    }
    isOwner() {
        return this.user.type === 'owner';
    }
    isManeger() {
        return this.user.type === 'maneger';
    }
    isAdminOrManeger() {
        if(this.user.type === 'admin' || this.user.type === 'maneger') {
            return true;
        }       
    }
}
