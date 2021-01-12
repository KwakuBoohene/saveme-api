export function  Change(e){
    this.setState({
        [e.target.name]: e.target.value
        });
}

export const Submit = (values) => {
    console.log(values);
}
