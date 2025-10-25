export default function CardContent ({ img, title, body }) {
    return (
        <div className="flex flex-row items-center bg-[--Pink-Secondary] rounded-[1.5rem] p-[1.5rem] gap-[1.5rem] transition duration-700 duration transform hover:-translate-y-5">
            <div className="bg-[--Pink-Primary] rounded-[1.5rem] flex justify-center items-center w-[4rem] h-[4rem] flex-shrink-0">
                <img
                    className="size-10"
                    src={img}
                    alt=""
                />
            </div>
            <div className="standard-content text-[--text-default]">
                <p className="font-mer text-h3 text-[--text-default]">{title}</p>
                <p className="font-mer text-body">
                    {body}
                </p>
            </div>
        </div>
    )
}