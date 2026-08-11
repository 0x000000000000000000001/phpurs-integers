module TestInt where
import Prelude
import Effect.Console (logShow)

main = do
  logShow (-5 / 3)
  logShow (-5 `mod` 3)
