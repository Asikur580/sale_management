import About from "./About/About";

export default function Home({page}) {
    return (
        <>
        <About />
        <h1 className="title text-center underline">Hello user</h1>
        </>
    );
}