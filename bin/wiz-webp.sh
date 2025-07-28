#!/bin/bash

QUALITY=${2:-90}
FOLDER="$(pwd)"
BATCH=$(date +"%Y%m%d-%H%M%S")

mkdir "$BATCH"

for INPUT in "$FOLDER"/*.{png,jpg}; do
  echo "Optimizing $INPUT..."

  # Step 1: Compress with jpegoptim
  FILENAME=$(basename -- "$INPUT")
  EXTENSION="${FILENAME##*.}"
  FILENAME="${FILENAME%.*}"

  NEW_FILE_NAME="${FILENAME}-q${QUALITY}"

  if [[ $EXTENSION == 'png' ]]; then
    pngquant --skip-if-larger --output="$BATCH/$NEW_FILE_NAME.$EXTENSION" --quality="$QUALITY" --speed=7 --strip "$INPUT"
  else
    jpegoptim --dest="$BATCH" "-m${QUALITY}" --all-progressive "$INPUT"

    RESULTS=$(find . -name "*.$EXTENSION" -type f | wc -l)

    if [[ $RESULTS -gt 0 ]]; then
      INPUT_FILE_NAME=$(basename -- "$INPUT")
      mv "$FOLDER/$BATCH/$INPUT_FILE_NAME" "$FOLDER/$BATCH/$NEW_FILE_NAME.$EXTENSION"
    fi
  fi

  RESULTS=$(find . -name "*.$EXTENSION" -type f | wc -l)

  if [[ $RESULTS -gt 0 ]]; then
    OPTIMIZED_DESTINATION="$FOLDER/$BATCH/optimized"
    mkdir -p "$OPTIMIZED_DESTINATION"
    # Step 2: Resize & Convert
    for SIZE in 1200 1024 720 480 240; do
      echo "Resizing to ${SIZE}px..."
      cwebp -q "${QUALITY}" "${FOLDER}/${BATCH}/${NEW_FILE_NAME}.${EXTENSION}" -o "$OPTIMIZED_DESTINATION/${NEW_FILE_NAME}-w${SIZE}.webp"
    done
  fi
done
