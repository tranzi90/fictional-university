import "./index.scss"
import {TextControl, Flex, FlexBlock, FlexItem, Button, Icon} from "@wordpress/components"

wp.blocks.registerBlockType("plugin/are-you-paying-attention", {
    title: "Are You Paying Attention?",
    icon: "smiley",
    category: "common",
    attributes: {
        question: {type: "string"},
        answers: {type: "array", default: ["dlc", "ng+"]}
    },
    edit: EditComponent,
    save: function () {
        return null
    }
})

function EditComponent({ attributes, setAttributes }) {
    function updateQuestion(value) {
        setAttributes({question: value})
    }

    function deleteAnswer(idxToDelete) {
        const newAnswers = attributes.answers.filter((x, idx) => idx !== idxToDelete)

        setAttributes({answers: newAnswers})
    }

    return (
        <div className="paying-attention-edit-block">
            <TextControl
                label="Question:"
                value={attributes.question}
                onChange={updateQuestion}
                style={{fontSize: "20px"}}
            />
            <p style={{fontSize: "13px", margin: "20px 0 8px 0"}}>Answers:</p>
            {attributes.answers.map(function (answer, idx) {
                return (
                    <Flex>
                        <FlexBlock>
                            <TextControl value={answer} onChange={newValue => {
                                const newAnswers = attributes.answers.concat([])
                                newAnswers[idx] = newValue
                                setAttributes({answers: newAnswers})
                            }} />
                        </FlexBlock>
                        <FlexItem>
                            <Button>
                                <Icon icon="star-empty" className="mark-as-correct" />
                            </Button>
                        </FlexItem>
                        <FlexItem>
                            <Button
                                isLink
                                className="attention-delete"
                                onClick={() => deleteAnswer(idx)}
                            >
                                Delete
                            </Button>
                        </FlexItem>
                    </Flex>
                )
            })}
            <Button isPrimary onClick={() => {
                setAttributes({answers: attributes.answers.concat([""])})
            }}>Add another answer</Button>
        </div>
    )
}