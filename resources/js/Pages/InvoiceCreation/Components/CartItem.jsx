import { truncatedParagraph } from "../../../utils/helpers";

export default function CartItem({
    itemImage,
    itemName,
    itemCategory,
    itemDes
}) {
    itemDes = truncatedParagraph(itemDes, 40);

    return (
        
            <div className="flex flex-col lg:flex-row lg:items-center gap-4">
                <div>
                    <img src={itemImage} alt={`Image of ${itemName}`} />
                </div>
                <div className="flex flex-col">
                    <p className="font-mer text-body">{itemName}</p>
                    <p className="font-mer text-body">{itemCategory}</p>
                    <p className="font-mer text-body">{itemDes}</p>
                </div>
            </div>
       
    );
}
